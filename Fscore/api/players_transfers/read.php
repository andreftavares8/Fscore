<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Transfers.php';
$players_transfers = new Players_Transfers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $players_transfers->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $players_transfers_arr = array();
    $players_transfers_arr["players transfers"] = array();
    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $players_transfers_item = array(

            "season" => $row['season'],
            "date_transfer" => $row['date_transfer'],
            "idtransfer"=>$row['idtransfer'],
            "idteam_out"=>$row['idteam_out'],
            "nickname_team_out"=>$row['nickname_team_out'],
            "logo_team_out"=>$row['logo_team_out'],
            "idcountry_team_out"=>$row['idcountry_team_out'],
            "name_country_team_out"=>$row['name_country_team_out'],
            "flag_country_team_out" => $row['flag_country_team_out'],
            "transfer_type" => $row['transfer_type'],
            "valor_transfer" => $row['valor_transfer'],
            "idplayer" => $row['idplayer'],
            "nickname_player" => $row['nickname_player'],
            "photo_player" => $row['photo_player'],
            "idcountry" => $row['idcountry'],
            "name_country_player" => $row['name_country_player'],
            "flag_country_player" => $row['flag_country_player'],
            "contract_date"=>$row['contract_date'],
            "valor_actual"=>$row['valor_actual'],
            "number_shirt" => $row['number_shirt'],
            "idteam_entry" => $row['idteam_entry'],
            "nickname_team_entry" => $row['nickname_team_entry'],
            "logo_team_entry" => $row['logo_team_entry'],
            "idcountry_team_entry" => $row['idcountry_team_entry'],
            "name_country_team_entry" => $row['name_country_team_entry'],
            "flag_country_team_entry" => $row['flag_country_team_entry']
     
        );
        
        array_push($players_transfers_arr["players transfers"], $players_transfers_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($players_transfers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}