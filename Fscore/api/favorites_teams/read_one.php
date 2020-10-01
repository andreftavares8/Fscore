<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Teams.php';
$favorites_teams = new Favorites_Teams($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$iduser = filter_input(INPUT_GET,'iduser',FILTER_SANITIZE_NUMBER_INT);
$idteam = filter_input(INPUT_GET,'idteam',FILTER_SANITIZE_NUMBER_INT);
$favorites_teams ->iduser=$iduser;
$favorites_teams ->idteam=$idteam;
$favorites_teams->readOne();

if ($favorites_teams->name_user != null) {

    // Array com o produto
    $favorites_teams_arr = array(

        "iduser" => $favorites_teams->iduser,
        "name_user" => $favorites_teams->name_user,
        "idteam" => $favorites_teams->idteam,
        "nickname_team" => $favorites_teams->nickname_team,
        "logo_team" => $favorites_teams->logo_team,
        "idcountry" => $favorites_teams->idcountry,
        "country_name" => $favorites_teams->country_name,
        "flag_country" => $favorites_teams->flag_country
           
    );

    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($favorites_teams_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}