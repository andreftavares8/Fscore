<?php

require_once '../config.php';
$pdo = connectDB($db_web);
//Carregar Classe
require_once '../objects/Teams.php';

// caregar as duas funcoes
require_once '../common/funcoes/funcoes.php';

$pesquisa  = filter_input(INPUT_POST,'palavra');
echo 'aquiiiii';
var_dump($pesquisa);
// Criar objeto da Classe
$teams = new Teams($pdo);
$stmt_teams = $teams->search($pesquisa);
var_dump($stmt_teams->fetch(PDO::FETCH_ASSOC));
return;
if ($num > 0) {
	$html .= '
		<tr id="jogos_encontros_sty" class="table-active">
		<th scope="row"></th>
			<td colspan="8" id="todos_jogos_encontros">Todos os Jogos</td>
		</tr>';
	// Apresentar conteudos dos paises
	while ($row_teams = $stmt_teams->fetch(PDO::FETCH_ASSOC)) {


        $html .= $row_teams['nickname'].'
        <img src="./logotipos/paises/'.$row_teams['logo_team'].'"/>';

    }
}
echo $html;
?>