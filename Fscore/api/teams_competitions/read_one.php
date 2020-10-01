<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams_Competitions.php';
$teams_competitions = new Teams_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idteam = filter_input(INPUT_GET,'idteam',FILTER_SANITIZE_NUMBER_INT);
$idcompetition = filter_input(INPUT_GET,'idcompetition',FILTER_SANITIZE_NUMBER_INT);
$teams_competitions ->idteam=$idteam;
$teams_competitions ->idcompetition=$idcompetition;
$teams_competitions->readOne();
if ($teams_competitions->nickname_team != null) {
    // Array com o produto
    $teams_competitions_arr = array(

        "season" => $teams_competitions->season,
        "idcompetition" => $teams_competitions->idcompetition,
        "name_competition" => $teams_competitions->name_competition,
        "logo_competition" => $teams_competitions->logo_competition,
        "competition_type" => $teams_competitions->competition_type,
        "logo_federation" => $teams_competitions->logo_federation,
        "logo_trophie" => $teams_competitions->logo_trophie,
        "idteam" => $teams_competitions->idteam,
        "nickname_team" => $teams_competitions->nickname_team,
        "logo_team" => $teams_competitions->logo_team,
        "competition_group" => $teams_competitions->competition_group,
        "competition_colectivo" => $teams_competitions->competition_colectivo,
        "idcountry" => $teams_competitions->idcountry,
        "name_country" => $teams_competitions->name_country,
        "flag_country" => $teams_competitions->flag_country
        
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($teams_competitions_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}