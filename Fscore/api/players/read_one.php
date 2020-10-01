<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players.php';
$players = new Players($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$players ->id=$id;
$players->readOne();

if ($players->nickname != null) {
    // Array com o produto
    $players_arr = array(

        "id" => $players->id,
        "name" => $players->name,
        "nickname" => $players->nickname,
        "birth_date" => $players->birth_date,
        "photo_player" => $players->photo_player,
        "weight" => $players->weight,
        "height" => $players->height,
        "position" => $players->position,
        "favorite_foot" => $players->favorite_foot,
        "idcountry" => $players->idcountry,
        "name_country" => $players->name_country,
        "flag_country" => $players->flag_country,
        "idteam_entry" => $players->idteam_entry,
        "nickname_team_entry" => $players->nickname_team_entry,
        "logo_team_entry" => $players->logo_team_entry,
        "season" => $players->season,
        "idtransfer" => $players->idtransfer,
        "date_transfer" => $players->date_transfer,
        "transfer_type" => $players->transfer_type,
        "valor_transfer" => $players->valor_transfer,
        "contract_date" => $players->contract_date,
        "valor_actual" => $players->valor_actual,
        "number_shirt" => $players->number_shirt
      
    );
    

    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}