<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Games_Clashes.php';
$manager_game_clashe = new Managers_Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idmanager = filter_input(INPUT_GET,'idmanager',FILTER_SANITIZE_NUMBER_INT);
$idgame_clashe = filter_input(INPUT_GET,'idgame_clashe',FILTER_SANITIZE_NUMBER_INT);
$manager_game_clashe ->idmanager=$idmanager;
$manager_game_clashe ->idgame_clashe=$idgame_clashe;
$manager_game_clashe->readOne();
if ($manager_game_clashe->nickname_manager != null) {
    // Array com o produto
    $manager_game_clashe_arr = array(

        "season" => $manager_game_clashe->season,
        "date_game" => $manager_game_clashe->date_game,
        "idgame_clashe" => $manager_game_clashe->idgame_clashe,
        "idmanager" => $manager_game_clashe->idmanager,
        "nickname_manager" => $manager_game_clashe->nickname_manager,
        "photo_manager" => $manager_game_clashe->photo_manager,
        "type_manager_game" => $manager_game_clashe->type_manager_game,
        "idteam_home" => $manager_game_clashe->idteam_home,
        "nickname_team_home" => $manager_game_clashe->nickname_team_home,
        "logo_team_home" => $manager_game_clashe->logo_team_home,
        "scores_home" => $manager_game_clashe->scores_home,
        "idteam_away" => $manager_game_clashe->idteam_away,
        "nickname_team_away" => $manager_game_clashe->nickname_team_away,
        "logo_team_away" => $manager_game_clashe->logo_team_away,
        "scores_away" => $manager_game_clashe->scores_away,
        "idcompetition" => $manager_game_clashe->idcompetition,
        "name_competition" => $manager_game_clashe->name_competition,
        "logo_competition" => $manager_game_clashe->logo_competition,
        "competition_type" => $manager_game_clashe->competition_type,
        "logo_federation" => $manager_game_clashe->logo_federation,
        "yellow_card" => $manager_game_clashe->yellow_card,
        "minutes_yellow" => $manager_game_clashe->minutes_yellow,
        "red_card" => $manager_game_clashe->red_card,
        "minutes_red" => $manager_game_clashe->minutes_red,
        "rating_points" => $manager_game_clashe->rating_points,
        "notes" => $manager_game_clashe->notes,
        "idcountry" => $manager_game_clashe->idcountry,
        "name_country" => $manager_game_clashe->name_country,
        "flag_country" => $manager_game_clashe->flag_country
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($manager_game_clashe_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}