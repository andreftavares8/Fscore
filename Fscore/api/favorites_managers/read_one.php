<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Managers.php';
$favorites_managers = new Favorites_Managers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$iduser = filter_input(INPUT_GET,'iduser',FILTER_SANITIZE_NUMBER_INT);
$idmanager = filter_input(INPUT_GET,'idmanager',FILTER_SANITIZE_NUMBER_INT);
$favorites_managers ->iduser=$iduser;
$favorites_managers ->idmanager=$idmanager;
$favorites_managers->readOne();

if ($favorites_managers->nickname_manager != null) {
    // Array com o produto
    $favorites_managers_arr = array(
        "iduser" => $favorites_managers->iduser,
        "name_user" => $favorites_managers->name_user,
        "idmanager" => $favorites_managers->idmanager,
        "nickname_manager" => $favorites_managers->nickname_manager,
        "photo_manager" => $favorites_managers->photo_manager,
        "country_name" => $favorites_managers->country_name,
        "flag_country" => $favorites_managers->flag_country
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($favorites_managers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}