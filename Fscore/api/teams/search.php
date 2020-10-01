<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams.php';
$teams = new Teams($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $teams->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $teams_arr = array();
        $teams_arr["teams"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $teams_item = array(

                "id"=>$row['id'],
                "name"=>$row['name'],
                "nickname"=>$row['nickname'],
                "city" => $row['city'],
                "foundation" => $row['foundation'],
                "president" => $row['president'],
                "logo_team" => $row['logo_team'],
                "logo_kit_home" => $row['logo_kit_home'],
                "logo_kit_away" => $row['logo_kit_away'],
                "idstadium" => $row['idstadium'],
                "name_stadium" => $row['name_stadium'],
                "logo_stadium" => $row['logo_stadium'],
                "capacity" => $row['capacity'],
                "city_stadium" => $row['city_stadium'],
                "foundation_stadium" => $row['foundation_stadium'],
                "grass_type" => $row['grass_type'],
                "idcountry" => $row['idcountry'],  
                "name_country"=>$row['name_country'],
                "flag_country"=>$row['flag_country']

            );
            array_push($teams_arr["teams"], $teams_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($teams_arr);
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

