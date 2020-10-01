<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers.php';
$managers = new Managers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $managers->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $managers_arr = array();
        $managers_arr["manager"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $managers_item = array(
                "id" => $row['id'],
            "name" => $row['name'],
            "nickname" => $row['nickname'],
            "birth_date" => $row['birth_date'],
            "photo_manager" => $row['photo_manager'],
            "favorite_tatic" => $row['favorite_tatic'],
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
            "valor_actual" => $row['valor_actual']

            );
            array_push($managers_arr["manager"], $managers_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($managers_arr);
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

