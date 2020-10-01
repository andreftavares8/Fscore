<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Transfers.php';
$players_transfers = new Players_Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// Obter ID e detalhes do produto
$idplayer = filter_var($data->idplayer,FILTER_SANITIZE_NUMBER_INT);
$idtransfer = filter_var($data->idtransfer,FILTER_SANITIZE_NUMBER_INT);
$players_transfers->idplayer= $idplayer;
$players_transfers->idtransfer= $idtransfer;
$players_transfers->readOne();

if ($players_transfers->nickname_player != null) {
    // Validar dados
    $idteam_out = filter_var($data->idteam_out,FILTER_SANITIZE_NUMBER_INT);
    $idteam_entry = filter_var($data->idteam_entry,FILTER_SANITIZE_NUMBER_INT);
    $contract_date =filter_var($data->contract_date,FILTER_SANITIZE_STRING);
    $valor_actual = (float)filter_var($data->valor_actual, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $number_shirt = filter_var($data->number_shirt,FILTER_SANITIZE_NUMBER_INT);
    
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
    if ($number_shirt == '') {
        $error .= 'number_shirt não definido. ';
    }
    if ($error == '') {
        $players_transfers->idteam_out =$idteam_out;
        $players_transfers->idteam_entry =$idteam_entry;
        $players_transfers->contract_date = date('Y-m-d',strtotime($contract_date));                        
        $players_transfers->valor_actual = $valor_actual;
        $players_transfers->number_shirt = $number_shirt;

        // Atualizar produto
        if ($players_transfers->update()) {
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
