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

// Obter ID e detalhes do produto
$id = filter_var($data->id,FILTER_SANITIZE_NUMBER_INT);
$games_clashes ->id= $id;
$games_clashes->readOne();

if ($competitions->name != null) {
    // Validar dados
    $idteam_home = filter_var($data->idteam_home, FILTER_SANITIZE_NUMBER_INT);
    $idteam_away = filter_var($data->idteam_away,FILTER_SANITIZE_NUMBER_INT);
    $idcompetition = filter_var($data->idcompetition, FILTER_SANITIZE_NUMBER_INT);
    $number_journey = filter_var($data->number_journey, FILTER_SANITIZE_NUMBER_INT);
    $date_game = filter_var($data->date_game, FILTER_SANITIZE_STRING);
    $time_game = filter_var($data->time_game, FILTER_SANITIZE_STRING);
    $season = filter_var($data->season, FILTER_SANITIZE_STRING);
    $idstadium = filter_var($data->idstadium, FILTER_SANITIZE_NUMBER_INT);
    $id = filter_var($data->id, FILTER_SANITIZE_NUMBER_INT);
   
    $error = '';
    if ($idteam_home == '') {
        $error .= 'idteam_home não definido. ';
    }
    if ($idteam_away == '') {
        $error .= 'idteam_away não definida. ';
    }
    if ($idcompetition == '') {
        $error .= 'idcompetitiono não definido.';
    }
    if ($number_journey == '') {
        $error .= 'number_journey não definido.';
    }
    if ($date_game == '') {
        $error .= 'date_game não definidas. ';
    }
    if ($time_game == '') {
        $error .= 'time_game não definido. ';
    }
    if ($season == '') {
        $error .= 'season não definida. ';
    }
    if ($idstadium == '') {
        $error .= 'idstadium não definida. ';
    }
    
    
    if ($error == '') {
        $games_clashes->idteam_home = $idteam_home;
        $games_clashes->idteam_away = $idteam_away;
        $games_clashes->idcompetition =$idcompetition;
        $games_clashes->number_journey =$number_journey;
        $games_clashes->date_game = date('Y-m-d',strtotime($date_game));                        
        $games_clashes->time_game = $time_game;
        $games_clashes->scores_home = $scores_home;
        $games_clashes->scores_away = $scores_away;
        $games_clashes->season = $season;
        $games_clashes->idstadium = $idstadium;

        // Atualizar produto
        if ($games_clashes->update()) {
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
