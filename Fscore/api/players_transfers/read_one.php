<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Transfers.php';
$players_transfers = new Players_Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$idplayer = filter_input(INPUT_GET,'idplayer',FILTER_SANITIZE_NUMBER_INT);
$idtransfer = filter_input(INPUT_GET,'idtransfer',FILTER_SANITIZE_NUMBER_INT);
$players_transfers ->idplayer=$idplayer;
$players_transfers ->idtransfer=$idtransfer;
$players_transfers->readOne();
if ($players_transfers->nickname_player != null) {
    // Array com o produto
    $players_transfers_arr = array(

        "season" => $players_transfers->season,
        "date_transfer" => $players_transfers->date_transfer,
        "idtransfer" => $players_transfers->idtransfer,
        "idteam_out" => $players_transfers->idteam_out,
        "nickname_team_out" => $players_transfers->nickname_team_out,
        "logo_team_out" => $players_transfers->logo_team_out,
        "idcountry_team_out" => $players_transfers->idcountry_team_out,
        "name_country_team_out" => $players_transfers->name_country_team_out,
        "flag_country_team_out" => $players_transfers->flag_country_team_out,
        "transfer_type" => $players_transfers->transfer_type,
        "valor_transfer" => $players_transfers->valor_transfer,
        "idplayer" => $players_transfers->idplayer,
        "nickname_player" => $players_transfers->nickname_player,
        "photo_player" => $players_transfers->photo_player,
        "idcountry" => $players_transfers->idcountry,
        "name_country_player" => $players_transfers->name_country_player,
        "flag_country_player" => $players_transfers->flag_country_player,
        "contract_date" => $players_transfers->contract_date,
        "valor_actual" => $players_transfers->valor_actual,
        "number_shirt" => $players_transfers->number_shirt,
        "idteam_entry" => $players_transfers->idteam_entry,
        "nickname_team_entry" => $players_transfers->nickname_team_entry,
        "logo_team_entry" => $players_transfers->logo_team_entry,
        "idcountry_team_entry" => $players_transfers->idcountry_team_entry,
        "name_country_team_entry" => $players_transfers->name_country_team_entry,
        "flag_country_team_entry" => $players_transfers->flag_country_team_entry
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_transfers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}