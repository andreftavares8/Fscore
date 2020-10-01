<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Games_Clashes.php';
require_once './objects/Countries.php';
require_once './objects/Competitions.php';

// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';

// Criar objeto da Classe
$encontros = new Games_Clashes($pdo);
$competicoes= new Competitions($pdo);


require_once './encontros/data.php';


$data  = filter_input(INPUT_POST,'data');
$dateToInput =  isset($data) && !empty($data) ? $data :  date('Y-m-d');


// tabela de jogos começo 
$html .='
<div class="container">
	<table class="table table-hover">
		<tbody>';

// Obter Produtos e numero de registos
$stmt_procura_data_jogo = $encontros->searchByGameDate($dateToInput);

// Obter Produtos e número de registos
$num = $stmt_procura_data_jogo->rowCount();

if ($num > 0) {
	$html .= '
		<tr id="jogos_encontros_sty" class="table-active">
		<th scope="row"></th>
			<td colspan="8" id="todos_jogos_encontros">
			Todos os Jogos</td>
		</tr>
		';
	// Apresentar conteudos dos paises
	while ($row_paises = $stmt_procura_data_jogo->fetch(PDO::FETCH_ASSOC)) {
		$html .= '
			<tr id="paises_encontros_sty">
				<th scope="row" id="a"></th>
				<td colspan="8" id="paises_encontros">
					<a href="?m=equipas&'.sanitizeString($row_paises['name']).'&a=equipa-internacional&'.sanitizeString($row_paises['name']).'&id='.$row_paises['idcountry'].'" id="paises_encontros">
						<img src="./logotipos/paises/'.$row_paises['flag_country'].'" id="img_pais"/>
					</a>
					<a href="?m=equipas&'.sanitizeString($row_paises['name']).'&a=equipa-internacional&'.sanitizeString($row_paises['name']).'&id='.$row_paises['idcountry'].'" id="paises_encontros">
						<span>'
							.$row_paises['name'].'
						</span>
					</a>
				</td>
			</tr>';
		// apresentar conteudos das competicoes
		$stmt_competicoes = $competicoes->searchCompetitionByCountry($row_paises['idcountry'], $dateToInput);
		while ($row_competicoes = $stmt_competicoes->fetch(PDO::FETCH_ASSOC)) {
			$html.='
			
						 
				<tr id="competicoes_encontros_sty">
					<th scope="row"></th>
					<td colspan="5" id="competicoes_encontros">
						<a href="?m=competicoes&'.sanitizeString($row_paises['name']).'&'.sanitizeString($row_competicoes['competition_type']).'&a=torneio&'.sanitizeString($row_competicoes['name']).'&id='.$row_competicoes['idcompetition'].'" id="competicoes_encontros">
							<img src="./logotipos/competicoes/'.$row_competicoes['logo_federation'].'" id="img_federation"> 
							<span>'
								.$row_competicoes['competition_type'].'
							</span>
						</a>
					</td>
					<td colspan="2" id="comp_encontros">
						<a href="?m=competicoes&'.sanitizeString($row_paises['name']).'&'.sanitizeString($row_competicoes['competition_type']).'&a=torneio&'.sanitizeString($row_competicoes['name']).'&id='.$row_competicoes['idcompetition'].'" id="competicoes_encontros">
							<img src="./logotipos/competicoes/'.$row_competicoes['logo_competition'].'" id="img_logo_competition"/> 
							<span>'
								.$row_competicoes['name'].'
							</span>
						</a>
					</td>
				</tr>';
			//apresentar conteudos do jogos
			$stmt_procura_jogos = $encontros->searchByCompetionIdAndDate($row_competicoes['idcompetition'], $dateToInput);				
			while ($row_encontros = $stmt_procura_jogos->fetch(PDO::FETCH_ASSOC)) {
				if(($row_encontros['scores_home'] === null)&&($row_encontros['scores_away']=== null)){
					$html.= '
						<tr id="equipas_encontros_sty">
							<th scope="row"></th>
							<td colspan="4" id="txt_team_home_encontros">
								<a href="?m='.$module.'&'.sanitizeString($row_paises['name']).'&a=jogo&'.sanitizeString($row_encontros['home_nickname']).'-'.sanitizeString($row_encontros['away_nickname']).'&id='.$row_encontros['idgame'].'" id="equipas_encontros">'
									.$row_encontros['home_nickname'].'
									<span>
										<img src="./logotipos/clubes/'.$row_encontros['home_logo_team'].'" id="logo_team"/>
									</span>
								</a>
							</td>
							<td id="time_encontros">
								<span>
									Hora<br>
									'.date('H:i',strtotime($row_encontros['time_game'])).'</span>
							</td>
							<td id="txt_team_away_encontros">
								<a href="?m='.$module.'&'.sanitizeString($row_paises['name']).'&a=jogo&'.sanitizeString($row_encontros['home_nickname']).'-'.sanitizeString($row_encontros['away_nickname']).'&id='.$row_encontros['idgame'].'" id="equipas_encontros">
									<img src="./logotipos/clubes/'.$row_encontros['away_logo_team'].'" id="logo_team"/>
									<span>
										'.$row_encontros['away_nickname'].
									'</span>
								</a>
							</td>
						</tr>';
				}else{
					$html.= '
						<tr id="equipas_encontros_sty">
							<th scope="row"></th>
							<td colspan="4" id="txt_team_home_encontros">
								<a href="?m='.$module.'&'.sanitizeString($row_paises['name']).'&a=jogo&'.sanitizeString($row_encontros['home_nickname']).'-'.sanitizeString($row_encontros['away_nickname']).'&id='.$row_encontros['idgame'].'" id="equipas_encontros">'
									.$row_encontros['home_nickname'].'
									<span>
										<img src="./logotipos/clubes/'.$row_encontros['home_logo_team'].'" id="logo_team"/>
									</span>
								</a>
							</td>
							<td id="scores_encontros">
								<a href="?m='.$module.'&'.sanitizeString($row_paises['name']).'&a=jogo&'.sanitizeString($row_encontros['home_nickname']).'-'.sanitizeString($row_encontros['away_nickname']).'&id='.$row_encontros['idgame'].'"id="scores_encontros">
									<span>'
										.$row_encontros['scores_home'].'
									</span> 
									-
									<span>'
										.$row_encontros['scores_away'].'
									</span>
								</a>
							</td>
							<td id="txt_team_away_encontros">
								<a href="?m='.$module.'&'.sanitizeString($row_paises['name']).'&a=jogo&'.sanitizeString($row_encontros['home_nickname']).'-'.sanitizeString($row_encontros['away_nickname']).'&id='.$row_encontros['idgame'].'" id="equipas_encontros">
									<img src="./logotipos/clubes/'.$row_encontros['away_logo_team'].'" id="logo_team"/>
									<span>
										'.$row_encontros['away_nickname'].
									'</span>
								</a>
							</td>
						</tr>';
				}	
			}
		}
	}
	$html.= '</tbody></table></div>';
} else {
    $html .='
        
    <div class="container clearfix">
        <div class="col-md-12 text-center">
            <img src="./logotipos/icons/no_event.png" id="no_event"/><br/><br/>
            <span id="no_event_text"><p>Não existe jogos neste dia<p><br/>
                <p>Tente pesquisar no calendario por outro dia</p>
            </span>
        </div>
    </div>';
}


echo $date;
echo $html;
