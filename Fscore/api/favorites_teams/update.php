<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Teams.php';
$favorites_teams = new Favorites_Teams($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// Obter ID e detalhes do produto
$iduser = filter_var($data->iduser,FILTER_SANITIZE_NUMBER_INT);
$idteam = filter_var($data->idteam,FILTER_SANITIZE_NUMBER_INT);
$favorites_teams ->iduser= $iduser;
$favorites_teams ->idteam= $idteam;
$favorites_teams->readOne();

if ($favorites_teams->nickname_team != null) {

    // Validar dados
    $iduser = filter_var($data->iduser,FILTER_SANITIZE_NUMBER_INT);
    $idteam = filter_var($data->idteam,FILTER_SANITIZE_NUMBER_INT);
   
    $error = '';
    
    if ($iduser == '') {
        $error .= 'iduser não definido. ';
    }
    if ($idplayer == '') {
        $error .= 'idplayer não definido. ';
    }

    if ($error == '') {
        $favorites_teams->iduser = $iduser;
        $favorites_teams->idplayer = $idplayer;

        // Atualizar produto
        if ($favorites_teams->update()) {
            // Sucesso na atualização - 200 OK
            http_response_code(200);
            // Enviar resposta
            echo json_encode(array("message"=>"Registo atualizado"));
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta
            echo json_encode(array("messagem"=>"Erro ao atualizar registo"));
        }
    } else {
        // Erros no pedido - 400 bad request
        http_response_code(400);
        // Enviar resposta
        echo json_encode(array("message"=>$error));
    }
} else {
    // Não encontrou produto - 404 Not found
    http_response_code(400);
    // Enviar resposta
    echo json_encode(array("message"=>"Registo inesxistente"));
}
