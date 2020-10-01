<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Players.php';
$favorites_players = new Favorites_Players($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

if (!empty($data)) {
    // Validar dados
    $iduser = filter_var($data->iduser,FILTER_SANITIZE_NUMBER_INT);
    $idplayer = filter_var($data->idplayer,FILTER_SANITIZE_NUMBER_INT);
    
    $error = '';
    if ($iduser == '') {
        $error .= 'iduser não definido. ';
    }
    if ($idplayer == '') {
        $error .= 'idplayer não definido. ';
    }
    

    if ($error == '') {
        $favorites_players->iduser = $iduser;
        $favorites_players->idplayer = $idplayer;
        

        // Criar produto
        if ($favorites_players->create()) {
            // Sucesso na criação - 201 created
            http_response_code(201);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo criado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message"=>"Registo já foi criado"));
        }
    } else {
        // Erros no pedido - 400 bad request
        http_response_code(400);
        // Enviar resposta com mensagens de erro
        echo json_encode(array("message"=>$error));
    }
} else {
    // Erros no pedido - 400 bad request
    http_response_code(400);
    // Enviar resposta com mensagens de erro
    http_response_code(400);
    echo json_encode(array("messagem"=> "Pedido sem informação"));
}