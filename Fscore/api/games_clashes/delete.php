<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Games_Clashes.php';
$games_clashes = new Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// // Obter ID e detalhes do produto
$id = filter_var($data->id,FILTER_SANITIZE_NUMBER_INT);
$games_clashes ->id= $id;
$games_clashes->readOne();

if ($games_clashes->id != null) {
    if ($games_clashes->delete()) {
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
