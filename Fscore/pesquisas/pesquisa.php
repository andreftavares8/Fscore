<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Teams.php';
require_once './objects/Players.php';
require_once './objects/Managers.php';
require_once './objects/Competitions.php';

// Criar objeto da Classe
$teams = new Teams($pdo);
$players = new Players($pdo);
$manager = new Managers($pdo);
$competitions = new Competitions($pdo);
//funcao
require_once './common/funcoes/funcoes.php';
$submeter = filter_input(INPUT_POST, 'submeter');
if ($submeter) {
    // Verificar dados
	$pesquisa =  filter_input(INPUT_POST, 'pesquisa',FILTER_SANITIZE_STRING);
    
}
$html = '
<div class="container"><br><br>
	
	<div class="row" id="favs_titulo">
			<div class="col-sm" id="titulo_favs">Jogadores</div>
			<div class="col-sm" id="titulo_favs">Treinadores</div>
			<div class="col-sm" id="titulo_favs">Equipas</div>
			<div class="col-sm" id="titulo_favs">Competições</div>
	</div><br>
	<div class="row">
			<div class="col-sm">';


// Obter Produtos e numero de registos
$stmt_team = $teams->search($pesquisa);
$stmt_player = $players->search($pesquisa);
$stmt_manager = $manager->search($pesquisa);
$stmt_competition = $competitions->search($pesquisa);

$num_team = $stmt_team->rowCount();
$num_player = $stmt_player->rowCount();
$num_manager = $stmt_manager->rowCount();
$num_competitition = $stmt_competition->rowCount();

if (($num_team > 0)||($num_player > 0)||($num_manager > 0)||($num_competitition > 0)) {
	// Apresentar conteudos
	while ($row_player = $stmt_player->fetch(PDO::FETCH_ASSOC)) {
		if($row_player['nickname_team_entry'] === null){
			$html .= '
				<div class="row" id="todos_fav_add">
					<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
						<img src="./logotipos/jogadores/'.$row_player['photo_player'].'" id="photo_player_fav">
					</a>
					<div class="col-sm" id="fav_col">
						<div class="row"> 
							<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
								'.$row_player['nickname'].'
							</a>
						</div><br>
							<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
								'.$row_player['name_country'].'
							<img src="./logotipos/paises/'.$row_player['flag_country'].'" id="logo_flag_fav_pais">
						</a>
					</div>
				</div>';
		}else{
			$html .= '
				<div class="row" id="todos_fav_add">
					<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
						<img src="./logotipos/jogadores/'.$row_player['photo_player'].'" id="photo_player_fav">
					</a>
					<div class="col-sm" id="fav_col">
						<div class="row">
							<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
								'.$row_player['nickname'].'
								<p>
									<img src="./logotipos/clubes/'.$row_player['logo_team_entry'].'" id="logo_team_fav_team">
									'.$row_player['nickname_team_entry'].'
								</p>
							</a>
						</div><br>
							<a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname']).'&id='.$row_player['id'].'" id="a_fav">
								'.$row_player['name_country'].'
								<img src="./logotipos/paises/'.$row_player['flag_country'].'" id="logo_flag_fav_pais">
							</a>
					</div>
				</div>';
		}
	}
	$html .= '
		</div>
		<div class="col-sm">';

	while ($row_manager = $stmt_manager->fetch(PDO::FETCH_ASSOC)) {
		if($row_manager['nickname_team_entry'] === null){
			$html .= '
				<div class="row" id="todos_fav_add">
					<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
						<img src="./logotipos/treinadores/'.$row_manager['photo_manager'].'" id="photo_manager_fav">
					</a>
					<div class="col-sm" id="fav_col">
						<div class="row"> 
						<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
							'.$row_manager['nickname'].'</span><br>
						</a> 
					</div><br>
						<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
							'.$row_manager['name_country'].'
							<img src="./logotipos/paises/'.$row_manager['flag_country'].'" id="logo_flag_fav_pais">
						</a>
					</div>
				</div> ';
		}else{
			$html .= '
				<div class="row" id="todos_fav_add">
					<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
						<img src="./logotipos/treinadores/'.$row_manager['photo_manager'].'" id="photo_manager_fav">
					</a>
					<div class="col-sm" id="fav_col">
						<div class="row"> 
							<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
								'.$row_manager['nickname'].'</span><br>
								<p>
									'.$row_manager['nickname_team_entry'].' 
									<img src="./logotipos/clubes/'.$row_manager['logo_team_entry'].'" id="logo_team_fav_team">
								</p>
							</a>
						</div><br>
							<a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname']).'&id='.$row_manager['id'].'"id="a_fav">
								'.$row_manager['name_country'].'
								<img src="./logotipos/paises/'.$row_manager['flag_country'].'" id="logo_flag_fav_pais">
							</a>
						</div>
					</div> ';
		}
	}
	$html .='
		</div>
		<div class="col-sm">';

	while ($row_team = $stmt_team->fetch(PDO::FETCH_ASSOC)) {
			
			$html .= '
			<div class="row" id="todos_fav_add">
				<a href="?m=equipas&'.sanitizeString($row_team['name_country']).'&a=equipa&'.sanitizeString($row_team['nickname']).'&id='.$row_team['id'].'"id="a_fav">
					<img src="./logotipos/clubes/'.$row_team['logo_team'].'" id="logo_team_fav">
				</a>
				<div class="col-sm" id="fav_col">
					<div class="row"> 
						<a href="?m=equipas&'.sanitizeString($row_team['name_country']).'&a=equipa&'.sanitizeString($row_team['nickname']).'&id='.$row_team['id'].'"id="a_fav">
							'.$row_team['nickname'].'
						</a>
					</div><br>
					<a href="?m=equipas&'.sanitizeString($row_team['name_country']).'&a=equipa&'.sanitizeString($row_team['nickname']).'&id='.$row_team['id'].'"id="a_fav">
						'.$row_team['name_country'].'
						<img src="./logotipos/paises/'.$row_team['flag_country'].'" id="logo_flag_fav_pais">
					</a>
				</div>
			</div>';
	
	}
	$html .='
		</div>
		<div class="col-sm">';

	while ($row_competition = $stmt_competition->fetch(PDO::FETCH_ASSOC)) {
		$html .= '
			<div class="row" id="todos_fav_add">
				<a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name']).'&id='.$row_competition['id'].'"id="a_fav">
					<img src="./logotipos/competicoes/'.$row_competition['logo_competition'].'" id="logo_comp_fav_competicao">
				</a>
				<div class="col-sm" id="fav_col">   
					<div class="row">   
					<a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name']).'&id='.$row_competition['id'].'"id="a_fav">
						'.$row_competition['name'].'
					</a>
				</div><br>
					<a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name']).'&id='.$row_competition['id'].'"id="a_fav">
						'.$row_competition['name_country'].'
						<img src="./logotipos/paises/'.$row_competition['flag_country'].'" id="logo_flag_fav_pais">
					</a>
				</div>
			</div>';
	}
}

echo $html;