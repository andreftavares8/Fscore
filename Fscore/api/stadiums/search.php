<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Stadiums.php';
$stadiums = new Stadiums($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $stadiums->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $stadiums_arr = array();
        $stadiums_arr["stadium"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stadiums_item = array(

                "name"=>$row['name'],
                "logo_stadium"=>$row['logo_stadium'],
                "capacity" => $row['capacity'],
                "city" => $row['city'],
                "foundation" => $row['foundation'],
                "grass_type" => $row['grass_type'],
                "name_country" => $row['name_country'],
                "flag_country" => $row['flag_country']

            );
            array_push($stadiums_arr["stadium"], $stadiums_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($stadiums_arr);
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

