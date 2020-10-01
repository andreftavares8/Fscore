<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams_Competitions.php';
$teams_competitions = new Teams_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// // Obter ID e detalhes do produto
$idteam = filter_var($data->idteam,FILTER_SANITIZE_NUMBER_INT);
$idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
$teams_competitions->idteam= $idteam;
$teams_competitions->idcompetition= $idcompetition;
$teams_competitions->readOne();

if ($teams_competitions->nickname_team != null ) {
    if ($teams_competitions->delete()) {
        // Sucesso na eliminação - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode(array("message"=>"Registo eliminado"));
    } else {
        // Erros no pedido - 503 service unavailable
        http_response_code(200);
        // Enviar resposta
        echo json_encode(array("message"=>"Erro ao eliminar registo"));
    }
} else {
    // Não encontrou produto - 404 Not found
    http_response_code(200);
    // Enviar resposta
        echo json_encode(array("message"=>"Registo inesxistente "));
}
