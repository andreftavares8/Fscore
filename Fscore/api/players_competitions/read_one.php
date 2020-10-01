<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Competitions.php';
$players_competitions = new Players_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idplayer = filter_input(INPUT_GET,'idplayer',FILTER_SANITIZE_NUMBER_INT);
$idcompetition = filter_input(INPUT_GET,'idcompetition',FILTER_SANITIZE_NUMBER_INT);
$players_competitions ->idplayer=$idplayer;
$players_competitions ->idcompetition=$idcompetition;
$players_competitions->readOne();
if ($players_competitions->nickname_player != null) {
    // Array com o produto
    $players_competitions_arr = array(

        "season" => $players_competitions->season,
        "idcompetition" => $players_competitions->idcompetition,
        "name_competition" => $players_competitions->name_competition,
        "logo_competition" => $players_competitions->logo_competition,
        "competition_type" => $players_competitions->competition_type,
        "logo_federation" => $players_competitions->logo_federation,
        "logo_trophie" => $players_competitions->logo_trophie,
        "idplayer" => $players_competitions->idplayer,
        "nickname_player" => $players_competitions->nickname_player,
        "photo_player" => $players_competitions->photo_player,
        "colectivo_competition" => $players_competitions->colectivo_competition,
        "individual_competition" => $players_competitions->individual_competition,
        "idcountry" => $players_competitions->idcountry,
        "name_country" => $players_competitions->name_country,
        "flag_country" => $players_competitions->flag_country
        
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_competitions_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}