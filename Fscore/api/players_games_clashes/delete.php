<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Games_Clashes.php';
$players_games_clashes = new Players_Games_Clashes($pdo);

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
$idgame_clashe = filter_var($data->idgame_clashe,FILTER_SANITIZE_NUMBER_INT);
$players_games_clashes->idplayer= $idplayer;
$players_games_clashes->idgame_clashe= $idgame_clashe;
$players_games_clashes->readOne();

if ($players_games_clashes->nickname_player != null ) {
    if ($players_games_clashes->delete()) {
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
