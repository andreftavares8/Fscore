<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Competitions.php';
$managers_competitions = new Managers_Competitions($pdo);

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
$idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
$managers_competitions->idmanager= $idmanager;
$managers_competitions->idcompetition= $idcompetition;
$managers_competitions->readOne();

if ($managers_competitions->nickname_manager != null) {
    // Validar dados
    $colectivo_competition = filter_var($data->colectivo_competition,FILTER_SANITIZE_STRING);
    $individual_competition = filter_var($data->individual_competition,FILTER_SANITIZE_STRING);
   
    $error = '';
    if ($colectivo_competition == '') {
        $error .= 'colectivo_competition não definido. ';
    }
    if ($individual_competition == '') {
        $error .= 'individual_competition não definido. ';
    }

    if ($error == '') {
        $managers_competitions->colectivo_competition = $colectivo_competition;
        $managers_competitions->individual_competition = $individual_competition;
       

        // Atualizar produto
        if ($managers_competitions->update()) {
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
