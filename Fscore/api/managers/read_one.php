<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers.php';
$managers = new Managers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$managers ->id=$id;
$managers->readOne();

if ($managers->nickname != null) {
    // Array com o produto
   
    $managers_arr = array(
        "id" => $managers->id,
        "name" => $managers->name,
        "nickname" => $managers->nickname,
        "birth_date" => $managers->birth_date,
        "photo_manager" => $managers->photo_manager,
        "favorite_tatic" => $managers->favorite_tatic,
        "idcountry" => $managers->idcountry,
        "name_country" => $managers->name_country,
        "flag_country" => $managers->flag_country,
        "idteam_entry" => $managers->idteam_entry,
        "nickname_team_entry" => $managers->nickname_team_entry,
        "logo_team_entry" => $managers->logo_team_entry,
        "season" => $managers->season,
        "idtransfer" => $managers->idtransfer,
        "date_transfer" => $managers->date_transfer,
        "transfer_type" => $managers->transfer_type,
        "valor_transfer" => $managers->valor_transfer,
        "contract_date" => $managers->contract_date,
        "valor_actual" => $managers->valor_actual,
        
    ); 
   
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($managers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}