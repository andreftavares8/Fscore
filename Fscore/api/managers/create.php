<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers.php';
$managers = new Managers($pdo);

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
    $photo_manager = filter_var($data->photo_manager,FILTER_SANITIZE_STRING);
    $favorite_tatic =filter_var($data->favorite_tatic,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
    
    $error = '';
    
    
    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($nickname == '') {
        $error .= 'nickname não definido.';
    }
    if ($birth_date == '') {
        $error .= 'birth_date não definido.';
    }
    if ($photo_manager == '') {
        $error .= 'photo_manager não definida. ';
    }
    if ($favorite_tatic == '') {
        $error .= 'favorite_tatic não definido. ';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definido. ';
    }
    
    if ($error == '') {
        $managers->id = $id;
        $managers->name = $name;
        $managers->nickname = $nickname;
        $managers->birth_date =date('Y-m-d',strtotime($birth_date));
        $managers->photo_manager =$photo_manager;
        $managers->favorite_tatic = $favorite_tatic;                        
        $managers->idcountry = $idcountry;
        

        // Criar produto
        if ($managers->create()) {
            // Sucesso na criação - 201 created
            http_response_code(201);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo criado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message"=>"Erro ao criar registo"));
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