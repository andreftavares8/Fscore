<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Competitions.php';
$players_competitions = new Players_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// // Obter ID e detalhes do produto
$idplayer = filter_var($data->idplayer,FILTER_SANITIZE_NUMBER_INT);
$idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
$players_competitions->idplayer= $idplayer;
$players_competitions->idcompetition= $idcompetition;
$players_competitions->readOne();

if ($players_competitions->nickname_player != null ) {
    if ($players_competitions->delete()) {
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
