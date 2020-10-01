<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Managers.php';
$favorites_managers = new Favorites_Managers($pdo);

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
    $idmanager = filter_var($data->idmanager,FILTER_SANITIZE_NUMBER_INT);
    
    $error = '';
    if ($iduser == '') {
        $error .= 'iduser não definido. ';
    }
    if ($idmanager == '') {
        $error .= 'idmanager não definido. ';
    }
    

    if ($error == '') {
        $favorites_managers->iduser = $iduser;
        $favorites_managers->idmanager = $idmanager;
        

        // Criar produto
        if ($favorites_managers->create()) {
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