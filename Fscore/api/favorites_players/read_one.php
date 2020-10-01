<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Players.php';
$favorites_players = new Favorites_Players($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Obter ID e detalhes do produto
$iduser = filter_input(INPUT_GET,'iduser',FILTER_SANITIZE_NUMBER_INT);
$idplayer = filter_input(INPUT_GET,'idplayer',FILTER_SANITIZE_NUMBER_INT);
$favorites_players ->iduser=$iduser;
$favorites_players ->idplayer=$idplayer;
$favorites_players->readOne();

if ($favorites_players->nickname_player != null) {

    // Array com o produto
    $favorites_players_arr = array(
        "iduser" => $favorites_players->iduser,
        "name_user" => $favorites_players->name_user,
        "idplayer" => $favorites_players->idplayer,
        "nickname_player" => $favorites_players->nickname_player,
        "photo_player" => $favorites_players->photo_player,
        "nickname_player" => $favorites_players->nickname_player,
        "flag_country" => $favorites_players->flag_country
        
    );
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($favorites_players_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}