<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players.php';
$players = new Players($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $players->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $players_arr = array();
        $players_arr["player"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $players_item = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "nickname" => $row['nickname'],
                "birth_date" => $row['birth_date'],
                "photo_player" => $row['photo_player'],
                "weight_player" => $row['weight'],
                "height_player" => $row['height'],
                "position" => $row['position'],
                "favorite_foot" => $row['favorite_foot'],
                "idcountry" => $row['idcountry'],
                "name_country" => $row['name_country'],
                "flag_country" => $row['flag_country'],
                "idteam_entry" => $row['idteam_entry'],
                "nickname_team_entry" => $row['nickname_team_entry'],
                "logo_team_entry" => $row['logo_team_entry'],
                "season" => $row['season'],
                "idtransfer" => $row['idtransfer'],
                "date_transfer" => $row['date_transfer'],
                "transfer_type" => $row['transfer_type'],
                "valor_transfer" => $row['valor_transfer'],
                "contract_date" => $row['contract_date'],
                "valor_actual" => $row['valor_actual'],
                "number_shirt" => $row['number_shirt'] 

            );
            array_push($players_arr["player"], $players_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($players_arr);
    } else {
        // Não encontrou registos - 404 Not found
        http_response_code(404);
        // Enviar resposta
        echo json_encode(array("message"=>"nenhum registo encontrado"));
    }
} else {
    // Erros no pedido - 400 bad request
    http_response_code(400);
    // Enviar resposta
    echo json_encode(array("message"=>"Pedido sem informaçao"));
}

