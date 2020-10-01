<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Countries.php';
$countries = new Countries($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $countries->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $countries_arr = array();
    $countries_arr["countries"] = array();

    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $countries_item = array(

            "name" => $row['name'],
            "flag_country" => $row['flag_country']
        );
        array_push($countries_arr["countries"], $countries_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($countries_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}