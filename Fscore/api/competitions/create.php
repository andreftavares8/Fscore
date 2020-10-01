<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Competitions.php';
$competitions = new Competitions($pdo);

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
    $competition_type = filter_var($data->competition_type,FILTER_SANITIZE_STRING);
    $start_date = filter_var($data->start_date,FILTER_SANITIZE_STRING);
    $end_date = filter_var($data->end_date,FILTER_SANITIZE_STRING);
    $number_journeys =filter_var($data->number_journeys,FILTER_SANITIZE_NUMBER_INT);
    $logo_competition = filter_var($data->logo_competition,FILTER_SANITIZE_STRING);
    $logo_federation = filter_var($data->logo_federation,FILTER_SANITIZE_STRING);
    $logo_trophie = filter_var($data->logo_trophie,FILTER_SANITIZE_STRING);
    $season = filter_var($data->season,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
    
    $error = '';
    if ($name == '') {
        $error .= 'name da competição não definido. ';
    }
    if ($competition_type == '') {
        $error .= 'competition_type não definida. ';
    }
    if ($start_date == '') {
        $error .= 'start_date da competição não definido.';
    }
    if ($end_date == '') {
        $error .= 'end_date não definido.';
    }
    if ($number_journeys == '') {
        $error .= 'number_journeys não definidas. ';
    }
    if ($logo_competition == '') {
        $error .= 'logo_competition não definido. ';
    }
    if ($logo_federation == '') {
        $error .= 'logo_federation não definido. ';
    }
    if ($logo_trophie == '') {
        $error .= 'logo_trophie não definido. ';
    }
    if ($season == '') {
        $error .= 'season não definido. ';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definido. ';
    }
    
    if ($error == '') {
        
        $competitions->name = $name;
      
        $competitions->competition_type = $competition_type;
        $competitions->start_date =date('Y-m-d',strtotime($start_date));
        //$competitions->end_date =date('Y-m-d',strtotime($end_date));
        $competitions->number_journeys = $number_journeys;                        
        $competitions->logo_competition = $logo_competition;
        $competitions->logo_federation = $logo_federation;
        $competitions->logo_trophie = $logo_trophie;
        $competitions->season = $season;
        $competitions->idcountry = $idcountry;
        // Criar produto
        if ($competitions->create()) {
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