<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Stadiums.php';
$stadiums = new Stadiums($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$stadiums ->id=$id;
$stadiums->readOne();

if ($stadiums->name != null) {
    // Array com o produto
    $stadiums_arr = array(

        "name" => $stadiums->name,
        "logo_stadium" => $stadiums->logo_stadium,
        "capacity" => $stadiums->capacity,
        "city" => $stadiums->city,
        "foundation" => $stadiums->foundation,
        "grass_type" => $stadiums->grass_type,
        "name_country" => $stadiums->name_country,
        "flag_country" => $stadiums->flag_country
        
        
    );

    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($stadiums_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}