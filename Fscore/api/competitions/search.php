<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Competitions.php';
$competitions = new Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $competitions->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $competitions_arr = array();
        $competitions_arr["competicoes"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $competitions_item = array(

                "season" => $row['season'],
                "idcountry"=>$row['idcountry'],
                "name_country"=>$row['name_country'],
                "flag_country"=>$row['flag_country'],
                "id"=>$row['id'],
                "name" => $row['name'],
                "competition_type" => $row['competition_type'],
                "start_date" => $row['start_date'],
                "end_date" => $row['end_date'],
                "number_journeys" => $row['number_journeys'],
                "logo_competition" => $row['logo_competition'],
                "logo_federation" => $row['logo_federation'],
                "logo_trophie" => $row['logo_trophie']

            );
            array_push($competitions_arr["competicoes"], $competitions_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($competitions_arr);
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

