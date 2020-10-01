<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Games_Clashes.php';
$games_clashes = new Games_Clashes($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// Obter ID e detalhes do produto
$id = filter_var($data->id,FILTER_SANITIZE_NUMBER_INT);
$games_clashes ->id=$id;
$games_clashes->readOne();



if ($games_clashes->name_competition != null) {var_dump($games_clashes->idcountry);
    // Array com o produto
   
    $games_clashes_arr = array(
        "season" => $games_clashes->season,
        "idcountry"=> $games_clashes->$idcountry,
        "name_country" => $games_clashes->name_country,
        "flag_country" => $games_clashes->flag_country,
        "idcompetition" => $games_clashes->idcompetition,
        "competition_type" => $games_clashes->competition_type,
        "logo_federation" => $games_clashes->logo_federation,
        "name_competition" => $games_clashes->name_competition,
        "logo_competition" => $games_clashes->logo_competition,
        "id" => $games_clashes->id,
        "number_journey" => $games_clashes->number_journey,
        "date_game" => $games_clashes->date_game,
        "time_game" => $games_clashes->time_game,
        "idteam_home" => $games_clashes->idteam_home,
        "home_nickname" => $games_clashes->home_nickname,
        "home_logo_team" => $games_clashes->home_logo_team,
        "home_logo_kit" => $games_clashes->home_logo_kit,
        "scores_home" => $games_clashes->scores_home,
        "idteam_away" => $games_clashes->idteam_away,
        "away_nickname" => $games_clashes->away_nickname,
        "away_logo_team" => $games_clashes->away_logo_team,
        "away_logo_kit" => $games_clashes->away_logo_kit,
        "scores_away" => $games_clashes->scores_away
        
    );
   
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($games_clashes_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}