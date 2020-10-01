<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Games_Clashes.php';
$players_games_clashes = new Players_Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idplayer = filter_input(INPUT_GET,'idplayer',FILTER_SANITIZE_NUMBER_INT);
$idgame_clashe = filter_input(INPUT_GET,'idgame_clashe',FILTER_SANITIZE_NUMBER_INT);
$players_games_clashes ->idplayer=$idplayer;
$players_games_clashes ->idgame_clashe=$idgame_clashe;
$players_games_clashes->readOne();
if ($players_games_clashes->nickname_player != null) {
    // Array com o produto
    $players_games_clashes_arr = array(

        "season" => $players_games_clashes->season,
        "date_game" => $players_games_clashes->date_game,
        "idgame_clashe" => $players_games_clashes->idgame_clashe,
        "idplayer" => $players_games_clashes->idplayer,
        "nickname_player" => $players_games_clashes->nickname_player,
        "photo_player" => $players_games_clashes->photo_player,
        "type_player_game" => $players_games_clashes->type_player_game,
        "idteam_home" => $players_games_clashes->idteam_home,
        "nickname_team_home" => $players_games_clashes->nickname_team_home,
        "logo_team_home" => $players_games_clashes->logo_team_home,
        "scores_home" => $players_games_clashes->scores_team_home,
        "idteam_away" => $players_games_clashes->idteam_away,
        "nickname_team_away" => $players_games_clashes->nickname_team_away,
        "logo_team_away" => $players_games_clashes->logo_team_away,
        "scores_away" => $players_games_clashes->scores_team_away,
        "idcompetition" => $players_games_clashes->idcompetition,
        "name_competition" => $players_games_clashes->name_competition,
        "logo_competition" => $players_games_clashes->logo_competition,
        "competition_type" => $players_games_clashes->competition_type,
        "logo_federation" => $players_games_clashes->logo_federation,
        "training_type" => $players_games_clashes->training_type,
        "yellow_card" => $players_games_clashes->yellow_card,
        "minutes_yellow" => $players_games_clashes->minutes_yellow,
        "red_card" => $players_games_clashes->red_card,
        "minutes_red" => $players_games_clashes->minutes_red,
        "goals_conceded" => $players_games_clashes->goals_conceded,
        "goals_scored" => $players_games_clashes->goals_scored,
        "minutes_goals" => $players_games_clashes->minutes_goals,
        "assistance" => $players_games_clashes->assistance,
        "minutes_assistance" => $players_games_clashes->minutes_assistance,
        "subs_entry" => $players_games_clashes->subs_entry,
        "subs_out" => $players_games_clashes->subs_out,
        "rating_perfomance" => $players_games_clashes->rating_perfomance,
        "notes" => $players_games_clashes->notes,
        "idcountry" => $players_games_clashes->idcountry,
        "name_country" => $players_games_clashes->name_country,
        "flag_country" => $players_games_clashes->flag_country
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_games_clashes_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}