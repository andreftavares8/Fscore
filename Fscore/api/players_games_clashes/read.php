<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Games_Clashes.php';
$players_games_clashes = new Players_Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $players_games_clashes->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $players_games_clashes_arr = array();
    $players_games_clashes_arr["players games"] = array();
    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $players_games_clashes_item = array(

            "season" => $row['season'],
            "date_game" => $row['date_game'],
            "idgame_clashe"=>$row['idgame_clashe'],
            "idplayer"=>$row['idplayer'],
            "nickname_player"=>$row['nickname_player'],
            "photo_player"=>$row['photo_player'],
            "type_player_game"=>$row['type_player_game'],
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
            "training_type" => $row['training_type'],
            "yellow_card" => $row['yellow_card'],
            "minutes_yellow" => $row['minutes_yellow'],
            "red_card" => $row['red_card'],
            "minutes_red" => $row['minutes_red'],
            "goals_conceded" => $row['goals_conceded'],
            "goals_scored" => $row['goals_scored'],
            "minutes_goals" => $row['minutes_goals'],
            "assistance" => $row['assistance'],
            "minutes_assistance" => $row['minutes_assistance'],
            "subs_entry" => $row['subs_entry'],
            "subs_out" => $row['subs_out'],
            "rating_perfomance" => $row['rating_perfomance'],
            "notes" => $row['notes'],
            "idcountry" => $row['idcountry'],
            "name_country" => $row['name_country'],
            "flag_country" => $row['flag_country']
     
        );
        array_push($players_games_clashes_arr["players games"], $players_games_clashes_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_games_clashes_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}