<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Competitions.php';
$managers_competitions = new Managers_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idmanager = filter_input(INPUT_GET,'idmanager',FILTER_SANITIZE_NUMBER_INT);
$idcompetition = filter_input(INPUT_GET,'idcompetition',FILTER_SANITIZE_NUMBER_INT);
$managers_competitions ->idmanager=$idmanager;
$managers_competitions ->idcompetition=$idcompetition;
$managers_competitions->readOne();
if ($managers_competitions->nickname_manager != null) {
    // Array com o produto
    $managers_competitions_arr = array(

        "season" => $managers_competitions->season,
        "idcompetition" => $managers_competitions->idcompetition,
        "name_competition" => $managers_competitions->name_competition,
        "logo_competition" => $managers_competitions->logo_competition,
        "competition_type" => $managers_competitions->competition_type,
        "logo_federation" => $managers_competitions->logo_federation,
        "logo_trophie" => $managers_competitions->logo_trophie,
        "idmanager" => $managers_competitions->idmanager,
        "nickname_manager" => $managers_competitions->nickname_manager,
        "photo_manager" => $managers_competitions->photo_manager,
        "colectivo_competition" => $managers_competitions->colectivo_competition,
        "individual_competition" => $managers_competitions->individual_competition,
        "idcountry" => $managers_competitions->idcountry,
        "name_country" => $managers_competitions->name_country,
        "flag_country" => $managers_competitions->flag_country
        
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($managers_competitions_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}