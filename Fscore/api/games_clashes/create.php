<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Games_Clashes.php';
$games_clashes = new Games_Clashes($pdo);

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
    $id = filter_var($data->id,FILTER_SANITIZE_NUMBER_INT);
    $idteam_home = filter_var($data->idteam_home,FILTER_SANITIZE_NUMBER_INT);
    $idteam_away = filter_var($data->idteam_away,FILTER_SANITIZE_NUMBER_INT);
    $idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
    $number_journey = filter_var($data->number_journey,FILTER_SANITIZE_NUMBER_INT);
    $date_game =filter_var($data->date_game,FILTER_SANITIZE_STRING);
    $time_game = filter_var($data->time_game,FILTER_SANITIZE_STRING);
    $season = filter_var($data->season,FILTER_SANITIZE_STRING);
    
    $error = '';
    
    if ($idteam_home == '') {
        $error .= 'idteam_home não definido. ';
    }
    if ($idteam_away == '') {
        $error .= 'idteam_away não definido. ';
    }
    if ($idcompetition == '') {
        $error .= 'idcompetition não definido.';
    }
    if ($number_journey == '') {
        $error .= 'number_journey não definido.';
    }
    if ($date_game == '') {
        $error .= 'date_game não definida. ';
    }
    if ($time_game == '') {
        $error .= 'time_game não definido. ';
    }
    if ($season == '') {
        $error .= 'season não definida. ';
    }
    
    
    if ($error == '') {

        $games_clashes->id = $id;
        $games_clashes->idteam_home = $idteam_home;
        $games_clashes->idteam_away = $idteam_away;
        $games_clashes->idcompetition =$idcompetition;
        $games_clashes->number_journey =$number_journey;
        $games_clashes->date_game = date('Y-m-d',strtotime($date_game));                        
        $games_clashes->time_game =$time_game;
        $games_clashes->season = $season;
        // Criar produto
        if ($games_clashes->create()) {
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