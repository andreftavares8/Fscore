<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Games_Clashes.php';
$players_games_clashes = new Players_Games_Clashes($pdo);

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
$idgame_clashe = filter_var($data->idgame_clashe,FILTER_SANITIZE_NUMBER_INT);
$players_games_clashes->idplayer= $idplayer;
$players_games_clashes->idgame_clashe= $idgame_clashe;
$players_games_clashes->readOne();

if ($players_games_clashes->nickname_player != null) {
    // Validar dados
    $type_player_game = filter_var($data->type_player_game,FILTER_SANITIZE_STRING);
    $idteam_home = filter_var($data->idteam_home,FILTER_SANITIZE_NUMBER_INT);
    $idteam_away =filter_var($data->idteam_away,FILTER_SANITIZE_NUMBER_INT);
    $idcompetition = filter_var($data->idcompetition,FILTER_SANITIZE_NUMBER_INT);
    $training_type = filter_var($data->training_type,FILTER_SANITIZE_STRING);
    $yellow_card = filter_var($data->yellow_card,FILTER_SANITIZE_NUMBER_INT);
    $minutes_yellow = filter_var($data->minutes_yellow,FILTER_SANITIZE_STRING);
    $red_card = filter_var($data->red_card,FILTER_SANITIZE_NUMBER_INT);
    $minutes_red = filter_var($data->nominutes_redtes,FILTER_SANITIZE_STRING);
    $goals_conceded = filter_var($data->goals_conceded,FILTER_SANITIZE_NUMBER_INT);
    $goals_scored = filter_var($data->goals_scored,FILTER_SANITIZE_NUMBER_INT);
    $minutes_goals = filter_var($data->minutes_goals,FILTER_SANITIZE_STRING);
    $assistance = filter_var($data->assistance,FILTER_SANITIZE_NUMBER_INT);
    $minutes_assistance = filter_var($data->minutes_assistance,FILTER_SANITIZE_STRING);
    $rating_perfomance = (float)filter_var($data->rating_perfomance, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $subs_entry = filter_var($data->subs_entry,FILTER_SANITIZE_STRING);
    $subs_out =filter_var($data->subs_out,FILTER_SANITIZE_STRING);
    $notes = filter_var($data->notes,FILTER_SANITIZE_STRING);
    
    $error = '';
    
    if ($type_player_game == '') {
        $error .= 'type_player_game não definida. ';
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
    if ($training_type == '') {
        $error .= 'training_type não definido. ';
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
    if ($goals_conceded == '') {
        $error .= 'goals_conceded não definido. ';
    }
    if ($goals_scored == '') {
        $error .= 'goals_scored não definido. ';
    }
    if ($minutes_goals == '') {
        $error .= 'minutes_goals não definido. ';
    }
    if ($assistance == '') {
        $error .= 'assistance não definido. ';
    }
    if ($minutes_assistance == '') {
        $error .= 'minutes_assistance não definido. ';
    }
    if ($rating_perfomance == '') {
        $error .= 'rating_perfomance não definido. ';
    }
    if ($subs_entry == '') {
        $error .= 'subs_entry não definido. ';
    }
    if ($subs_out == '') {
        $error .= 'subs_out não definido. ';
    }
    if ($notes == '') {
        $error .= 'notes não definido. ';
    }
    
    if ($error == '') {
        $players_games_clashes->type_player_game = $type_player_game;
        $players_games_clashes->idteam_home =$idteam_home;
        $players_games_clashes->idteam_away = $idteam_away;                        
        $players_games_clashes->idcompetition = $idcompetition;
        $players_games_clashes->training_type = $training_type;
        $players_games_clashes->yellow_card = $yellow_card;
        $players_games_clashes->minutes_yellow = $minutes_yellow;
        $players_games_clashes->red_card = $red_card;
        $players_games_clashes->minutes_red = $minutes_red;
        $players_games_clashes->goals_conceded = $goals_conceded;
        $players_games_clashes->goals_scored = $goals_scored;
        $players_games_clashes->minutes_goals = $minutes_goals;
        $players_games_clashes->assistance = $assistance;
        $players_games_clashes->minutes_assistance = $minutes_assistance;
        $players_games_clashes->rating_perfomance = $rating_perfomance;
        $players_games_clashes->subs_entry = $subs_entry;
        $players_games_clashes->subs_out = $subs_out;
        $players_games_clashes->notes = $notes;

        // Atualizar produto
        if ($players_games_clashes->update()) {
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
