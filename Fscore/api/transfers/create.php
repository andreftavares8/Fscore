<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Transfers.php';
$transfers = new Transfers($pdo);

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
    $date_transfer = filter_var($data->date_transfer,FILTER_SANITIZE_STRING);
    $transfer_type = filter_var($data->transfer_type,FILTER_SANITIZE_STRING);
    $valor_transfer =  (float)filter_var($data->valor_transfer, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $idteam_out = filter_var($data->idteam_out,FILTER_SANITIZE_NUMBER_INT);
    $idteam_entry =filter_var($data->idteam_entry,FILTER_SANITIZE_NUMBER_INT);
    $season = filter_var($data->season,FILTER_SANITIZE_STRING);

    $error = '';
    if ($date_transfer == '') {
        $error .= 'date_transfer não definido. ';
    }
    if ($transfer_type == '') {
        $error .= 'transfer_type não definida. ';
    }
    if ($valor_transfer == '') {
        $error .= 'valor_transfer não definido.';
    }
    if ($idteam_out == '') {
        $error .= 'idteam_out não definido.';
    }
    if ($idteam_entry == '') {
        $error .= 'idteam_entry não definidas. ';
    }
    if ($season == '') {
        $error .= 'season não definido. ';
    }
    if ($error == '') {
        $transfers->date_transfer = date('Y-m-d',strtotime($date_transfer));
        $transfers->transfer_type = $transfer_type;
        $transfers->valor_transfer =$valor_transfer;
        $transfers->idteam_out =$idteam_out;
        $transfers->idteam_entry = $idteam_entry;                        
        $transfers->season = $season;
       
        // Criar produto
        if ($transfers->create()) {
            // Sucesso na criação - 201 created
            http_response_code(201);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo criado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message"=>"Erro ao criar registo..."));
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