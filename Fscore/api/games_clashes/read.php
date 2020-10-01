<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Games_Clashes.php';
$game_clashes = new Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $game_clashes->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $game_clashes_arr = array();
    $game_clashes_arr["jogos"] = array();

    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $game_clashes_item = array(
            
            "season" => $row['season'],
            "idcountry" => $row['idcountry'],
            "name_country" => $row['name_country'],
            "flag_country" => $row['flag_country'],
            "idcompetition" => $row['idcompetition'],
            "competition_type" => $row['competition_type'],
            "logo_federation" => $row['logo_federation'],
            "name_competition" => $row['name_competition'],
            "logo_competition" => $row['logo_competition'],
            "id" => $row['id'],
            "number_journey" => $row['number_journey'],
            "date_game" => $row['date_game'],
            "time_game" => $row['time_game'],
            "idteam_home" => $row['idteam_home'],
            "home_nickname" => $row['home_nickname'],
            "home_logo_team" => $row['home_logo_team'],
            "home_logo_kit" => $row['home_logo_kit'],
            "scores_home" => $row['scores_home'],
            "idteam_away" => $row['idteam_away'],
            "away_nickname" => $row['away_nickname'],
            "away_logo_team" => $row['away_logo_team'],
            "away_logo_kit" => $row['away_logo_kit'],
            "scores_away" => $row['scores_away']
            
        );
      
        array_push($game_clashes_arr["jogos"], $game_clashes_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($game_clashes_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}