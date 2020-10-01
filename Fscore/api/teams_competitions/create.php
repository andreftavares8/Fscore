<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams_Competitions.php';
$teams_competitions = new Teams_Competitions($pdo);

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
    $idteam = filter_var($data->idteam,FILTER_SANITIZE_NUMBER_INT);
    $idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
    $competition_group = filter_var($data->competition_group,FILTER_SANITIZE_STRING);
    $competition_colectivo = filter_var($data->competition_colectivo,FILTER_SANITIZE_STRING);
  
    $error = '';
    if ($idteam == '') {
        $error .= 'idteam não definido. ';
    }
    if ($idcompetition == '') {
        $error .= 'idcompetition não definido. ';
    }
    if ($competition_group == '') {
        $error .= 'competition_group não definido. ';
    }
    if ($competition_colectivo == '') {
        $error .= 'competition_colectivo não definido. ';
    }
   
    if ($error == '') {
        $teams_competitions->idteam = $idteam;
        $teams_competitions->idcompetition = $idcompetition;
        $teams_competitions->competition_group = $competition_group;
        $teams_competitions->competition_colectivo = $competition_colectivo;

        // Criar produto
        if ($teams_competitions->create()) {
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