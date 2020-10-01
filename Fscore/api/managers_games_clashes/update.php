<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Games_Clashes.php';
$managers_games_clashes = new Managers_Games_Clashes($pdo);

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
$idgame_clashe = filter_var($data->idgame_clashe,FILTER_SANITIZE_NUMBER_INT);
$managers_games_clashes->idmanager= $idmanager;
$managers_games_clashes->idgame_clashe= $idgame_clashe;
$managers_games_clashes->readOne();

if ($managers_games_clashes->nickname_manager != null) {
    // Validar dados
    $type_manager_game = filter_var($data->type_manager_game,FILTER_SANITIZE_STRING);
    $idteam_home = filter_var($data->idteam_home,FILTER_SANITIZE_NUMBER_INT);
    $idteam_away =filter_var($data->idteam_away,FILTER_SANITIZE_NUMBER_INT);
    $idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
    $minutes_yellow = filter_var($data->minutes_yellow,FILTER_SANITIZE_STRING);
    $yellow_card = filter_var($data->yellow_card,FILTER_SANITIZE_NUMBER_INT);
    $minutes_red = filter_var($data->nominutes_redtes,FILTER_SANITIZE_STRING);
    $red_card = filter_var($data->red_card,FILTER_SANITIZE_NUMBER_INT);
    $rating_points = (float)filter_var($data->rating_points, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $notes = filter_var($data->notes,FILTER_SANITIZE_STRING);
    
    $error = '';
    
    if ($type_manager_game == '') {
        $error .= 'type_manager_game não definida. ';
    }
    if ($idteam_home == '') {
        $error .= 'idteam_home não definido.';
    }
    if ($idteam_away == '') {
        $error .= 'idteam_away não definidas. ';
    }
    if ($idcompetition == '') {
        $error .= 'idcompetition não definido. ';
    }
    if ($yellow_card == '') {
        $error .= 'yellow_card não definido. ';
    }
    if ($minutes_yellow == '') {
        $error .= 'minutes_yellow não definido. ';
    }
    if ($red_card == '') {
        $error .= 'red_card não definido. ';
    }
    if ($minutes_red == '') {
        $error .= 'minutes_red não definido. ';
    }
    if ($rating_points == '') {
        $error .= 'rating_points não definido. ';
    }
    if ($notes == '') {
        $error .= 'notes não definido. ';
    }
    
    if ($error == '') {
       
        $managers_games_clashes->type_manager_game = $type_manager_game;
        $managers_games_clashes->idteam_home =$idteam_home;
        $managers_games_clashes->idteam_away = $idteam_away;                        
        $managers_games_clashes->idcompetition = $idcompetition;
        $managers_games_clashes->yellow_card = $yellow_card;
        $managers_games_clashes->minutes_yellow = $minutes_yellow;
        $managers_games_clashes->red_card = $red_card;
        $managers_games_clashes->minutes_red = $minutes_red;
        $managers_games_clashes->rating_points = $rating_points;
        $managers_games_clashes->notes = $notes;

        // Atualizar produto
        if ($managers_games_clashes->update()) {
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
