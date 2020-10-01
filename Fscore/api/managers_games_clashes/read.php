<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Games_Clashes.php';
$managers_games_clashes = new Managers_Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $managers_games_clashes->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $managers_games_clashes_arr = array();
    $managers_games_clashes_arr["managers games"] = array();
    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $managers_games_clashes_item = array(

            "season" => $row['season'],
            "date_game" => $row['date_game'],
            "idgame_clashe"=>$row['idgame_clashe'],
            "idmanager"=>$row['idmanager'],
            "nickname_manager"=>$row['nickname_manager'],
            "photo_manager"=>$row['photo_manager'],
            "type_manager_game"=>$row['type_manager_game'],
            "idteam_home"=>$row['idteam_home'],
            "nickname_team_home" => $row['nickname_team_home'],
            "logo_team_home" => $row['logo_team_home'],
            "scores_home" => $row['scores_home'],
            "idteam_away" => $row['idteam_away'],
            "nickname_team_away" => $row['nickname_team_away'],
            "logo_team_away" => $row['logo_team_away'],
            "scores_away" => $row['scores_away'],
            "idcompetition" => $row['idcompetition'],
            "name_competition" => $row['name_competition'],
            "logo_competition"=>$row['logo_competition'],
            "competition_type"=>$row['competition_type'],
            "logo_federation" => $row['logo_federation'],
            "yellow_card" => $row['yellow_card'],
            "minutes_yellow" => $row['minutes_yellow'],
            "red_card" => $row['red_card'],
            "minutes_red" => $row['minutes_red'],
            "rating_points" => $row['rating_points'],
            "notes" => $row['notes'],
            "idcountry" => $row['idcountry'],
            "name_country" => $row['name_country'],
            "flag_country" => $row['flag_country']
            
            
            
        );
        array_push($managers_games_clashes_arr["managers games"], $managers_games_clashes_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($managers_games_clashes_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}