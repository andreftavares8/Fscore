<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Transfers.php';
$transfers = new Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$transfers ->id=$id;
$transfers->readOne();
if ($transfers->date_transfer != null) {
    // Array com o produto
    $transfers_arr = array(

        "season" => $transfers->season,
        "date_transfer" => $transfers->date_transfer,
        "id" => $transfers->id,
        "transfer_type" => $transfers->transfer_type,
        "valor_transfer" => $transfers->valor_transfer,
        "idteam_out" => $transfers->idteam_out,
        "nickname_team_out" => $transfers->nickname_team_out,
        "logo_team_out" => $transfers->logo_team_out,
        "idcountry_team_out" => $transfers->idcountry_team_out,
        "name_country_team_out" => $transfers->name_country_team_out,
        "flag_country_team_out" => $transfers->flag_country_team_out,
        "idteam_entry" => $transfers->idteam_entry,
        "nickname_team_entry" => $transfers->nickname_team_entry,
        "logo_team_entry" => $transfers->logo_team_entry,
        "idcountry_team_entry" => $transfers->idcountry_team_entry,
        "name_country_team_entry" => $transfers->name_country_team_entry,
        "flag_country_team_entry" => $transfers->flag_country_team_entry
       
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($transfers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}