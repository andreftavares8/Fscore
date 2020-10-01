<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Transfers.php';
$managers_transfers = new Managers_Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// Obter ID e detalhes do produto
$idmanager = filter_var($data->idmanager,FILTER_SANITIZE_NUMBER_INT);
$idtransfer = filter_var($data->idtransfer,FILTER_SANITIZE_NUMBER_INT);
$managers_transfers->idmanager= $idmanager;
$managers_transfers->idtransfer= $idtransfer;
$managers_transfers->readOne();

if ($managers_transfers->nickname_manager != null) {
    // Validar dados
    $idteam_out = filter_var($data->idteam_out,FILTER_SANITIZE_NUMBER_INT);
    $idteam_entry = filter_var($data->idteam_entry,FILTER_SANITIZE_NUMBER_INT);
    $contract_date =filter_var($data->contract_date,FILTER_SANITIZE_STRING);
    $valor_actual = (float)filter_var($data->valor_actual, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    $error = '';
    if ($idteam_out == '') {
        $error .= 'idteam_out não definido.';
    }
    if ($idteam_entry == '') {
        $error .= 'idteam_entry não definido.';
    }
    if ($contract_date == '') {
        $error .= 'contract_date não definidas. ';
    }
    if ($valor_actual == '') {
        $error .= 'valor_actual não definido. ';
    }
    
    if ($error == '') {
        $managers_transfers->idteam_out =$idteam_out;
        $managers_transfers->idteam_entry =$idteam_entry;
        $managers_transfers->contract_date = date('Y-m-d',strtotime($contract_date));                        
        $managers_transfers->valor_actual = $valor_actual;

        // Atualizar produto
        if ($managers_transfers->update()) {
            // Sucesso na atualização - 200 OK
            http_response_code(200);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo atualizado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta
            echo json_encode(array("messagem"=>"Erro ao atualizar registo"));
        }
    } else {
        // Erros no pedido - 400 bad request
        http_response_code(400);
        // Enviar resposta
        echo json_encode(array("message"=>$error));
    }
} else {
    // Não encontrou produto - 404 Not found
    http_response_code(400);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}
