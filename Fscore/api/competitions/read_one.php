<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Competitions.php';
$competitions = new Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$competitions ->id=$id;
$competitions->readOne();

if ($competitions->name != null) {
    // Array com o produto
    $competitions_arr = array(

        "season" => $competitions->season,
        "idcountry" => $competitions->idcountry,
        "name_country" => $competitions->name_country,
        "flag_country" => $competitions->flag_country,
        "id" => $competitions->id,
        "name" => $competitions->name,
        "competition_type" => $competitions->competition_type,
        "start_date" => $competitions->start_date,
        "end_date" => $competitions->end_date,
        "number_journeys" => $competitions->number_journeys,
        "logo_competition" => $competitions->logo_competition,
        "logo_federation" => $competitions->logo_federation,
        "logo_trophie" => $competitions->logo_trophie
        
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($competitions_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}