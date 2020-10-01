<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }


//Carregar Classe
require_once './objects/Competitions.php';

// Criar objeto da Classe
$competicoes = new Competitions($pdo);

// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';
$html .= '
    <div class="container">
            <table class="table table-hover">
                <tbody>';
      
// Obter Produtos e numero de registos
$stmt_paises = $competicoes->read();

$num = $stmt_paises->rowCount();
if ($num > 0) {

    // Apresentar conteudos
    while ($row_paises = $stmt_paises->fetch(PDO::FETCH_ASSOC)) {
        
        $html .='
            <tr id="paises_competicoes_sty">
                <th scope="row"></th>
                <td colspan="8" id="paises_competicoes">
                    <a href="?m=equipas&'.sanitizeString($row_paises['name_country']).'&a=equipa-internacional&'.sanitizeString($row_paises['name_country']).'&id='.$row_paises['idteam'].'" id="paises_encontros">
                        <img src="./logotipos/paises/'.$row_paises['flag_country'].'" id="img_pais"/>
                        <span>'
                            .$row_paises['name_country'].'
                        </span>
                    </a>
                </td>
            </tr>';
    
        $stmt_competicoes = $competicoes->searchCompByCountry($row_paises['idcountry']);
        // Apresentar conteudos competicoes
        while ($row_competicoes = $stmt_competicoes->fetch(PDO::FETCH_ASSOC)) { 
            $html .='
                <tr id="competicoes_competicoes_sty">
                    <th scope="row"></th>
                    <td colspan="4" id="logo_competicoes_competicoes">
                        <a href="?m=competicoes&'.sanitizeString($row_competicoes['name_country']).'&'.sanitizeString($row_competicoes['competition_type']).'&a=torneio&'.sanitizeString($row_competicoes['name']).'&id='.$row_competicoes['idcompetition'].'" id="competicoes_competicoes">
                            <img src="./logotipos/competicoes/'.$row_competicoes['logo_competition'].'" id="img_logo_competition"/> 
                        </a>
                    </td>
                    <td id="competicoes_competicoes"> 
                        <a href="?m=competicoes&'.sanitizeString($row_competicoes['name_country']).'&'.sanitizeString($row_competicoes['competition_type']).'&a=torneio&'.sanitizeString($row_competicoes['name']).'&id='.$row_competicoes['idcompetition'].'" id="competicoes_competicoes">
                            <span>'
                                .$row_competicoes['name'].'
                            </span>
                        </a>
                    </td>
                </tr>';
        }
        
    }  

    $html .='</tbody></table></div>';
} else {
    $html .='';
}

echo $html;
