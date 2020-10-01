<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players.php';
$players = new Players($pdo);

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
    $name = filter_var($data->name,FILTER_SANITIZE_STRING);
    $nickname = filter_var($data->nickname,FILTER_SANITIZE_STRING);
    $birth_date = filter_var($data->birth_date,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
    $photo_player =filter_var($data->photo_player,FILTER_SANITIZE_STRING);
    $weight = filter_var($data->weight,FILTER_SANITIZE_NUMBER_INT);
    $height = filter_var($data->height,FILTER_SANITIZE_NUMBER_INT);
    $position = filter_var($data->position,FILTER_SANITIZE_STRING);
    $favorite_foot = filter_var($data->favorite_foot,FILTER_SANITIZE_STRING);
    
    $error = '';
    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($nickname == '') {
        $error .= 'nickname não definida. ';
    }
    if ($birth_date == '') {
        $error .= 'birth_date da competição não definido.';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definido.';
    }
    if ($photo_player == '') {
        $error .= 'photo_player não definidas. ';
    }
    if ($weight == '') {
        $error .= 'weight não definido. ';
    }
    if ($height == '') {
        $error .= 'height não definido. ';
    }
    if ($position == '') {
        $error .= 'position não definido. ';
    }
    if ($favorite_foot == '') {
        $error .= 'favorite_foot não definido. ';
    }
    
    
    if ($error == '') {
        
        $players->name = $name;
        $players->nickname = $nickname;
        $players->birth_date =date('Y-m-d',strtotime($birth_date));
        $players->idcountry = $idcountry;                        
        $players->photo_player = $photo_player;
        $players->weight = $weight;
        $players->height = $height;
        $players->position = $position;
        $players->favorite_foot = $favorite_foot;

        // Criar produto
        if ($players->create()) {
            // Sucesso na criação - 201 created
            http_response_code(201);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo criado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message"=>"Erro ao criar registo.. \n Precisa de registar um pais primeiro"));
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