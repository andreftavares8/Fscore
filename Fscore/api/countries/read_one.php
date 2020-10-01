<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Countries.php';
$countries = new Countries($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$countries ->id=$id;
$countries->readOne();

if ($countries->name != null) {
    // Array com o produto
    $countries_arr = array(

        "pais" => $countries->name,
        "bandeira" => $countries->flag_country
        
    );

    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($countries_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}