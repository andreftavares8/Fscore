<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Transfers.php';
$managers_transfers = new Managers_Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idmanager = filter_input(INPUT_GET,'idmanager',FILTER_SANITIZE_NUMBER_INT);
$idtransfer = filter_input(INPUT_GET,'idtransfer',FILTER_SANITIZE_NUMBER_INT);
$managers_transfers->idmanager=$idmanager;
$managers_transfers->idtransfer=$idtransfer;
$managers_transfers->readOne();
if ($managers_transfers->nickname_manager != null) {
    // Array com o produto
    $managers_transfers_arr = array(

        "season" => $managers_transfers->season,
        "date_transfer" => $managers_transfers->date_transfer,
        "idtransfer" => $managers_transfers->idtransfer,
        "idteam_out" => $managers_transfers->idteam_out,
        "nickname_team_out" => $managers_transfers->nickname_team_out,
        "logo_team_out" => $managers_transfers->logo_team_out,
        "idcountry_team_out" => $managers_transfers->idcountry_team_out,
        "name_country_team_out" => $managers_transfers->name_country_team_out,
        "flag_country_team_out" => $managers_transfers->flag_country_team_out,
        "transfer_type" => $managers_transfers->transfer_type,
        "valor_transfer" => $managers_transfers->valor_transfer,
        "idmanager" => $managers_transfers->idmanager,
        "nickname_manager" => $managers_transfers->nickname_manager,
        "photo_manager" => $managers_transfers->photo_manager,
        "idcountry" => $managers_transfers->idcountry,
        "name_country_manager" => $managers_transfers->name_country_manager,
        "flag_country_manager" => $managers_transfers->flag_country_manager,
        "contract_date" => $managers_transfers->contract_date,
        "valor_actual" => $managers_transfers->valor_actual,
        "idteam_entry" => $managers_transfers->idteam_entry,
        "nickname_team_entry" => $managers_transfers->nickname_team_entry,
        "logo_team_entry" => $managers_transfers->logo_team_entry,
        "idcountry_team_entry" => $managers_transfers->idcountry_team_entry,
        "name_country_team_entry" => $managers_transfers->name_country_team_entry,
        "flag_country_team_entry" => $managers_transfers->flag_country_team_entry
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($managers_transfers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}