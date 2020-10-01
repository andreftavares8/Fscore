<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams.php';
$teams = new Teams($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$teams ->id=$id;
$teams->readOne();

if ($teams->nickname != null) {
    // Array com o produto
    $teams_arr = array(

        "id" => $teams->id,
        "name" => $teams->name,
        "nickname" => $teams->nickname,
        "city" => $teams->city,
        "foundation" => $teams->foundation,
        "president" => $teams->president,
        "logo_team" => $teams->logo_team,
        "logo_kit_home" => $teams->logo_kit_home,
        "logo_kit_away" => $teams->logo_kit_away,
        "idstadium" => $teams->idstadium,
        "name_stadium" => $teams->name_stadium,
        "logo_stadium" => $teams->logo_stadium,
        "capacity" => $teams->capacity,
        "city_stadium" => $teams->city_stadium,
        "foundation_stadium" => $teams->foundation_stadium,
        "grass_type" => $teams->grass_type,
        "idcountry" => $teams->idcountry,
        "name_country" => $teams->name_country,
        "flag_country" => $teams->flag_country
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($teams_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}