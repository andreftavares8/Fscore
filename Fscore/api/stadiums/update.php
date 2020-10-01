<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Stadiums.php';
$stadiums = new Stadiums($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

// Obter ID e detalhes do produto
$id = filter_var($data->id,FILTER_SANITIZE_NUMBER_INT);
$stadiums ->id= $id;
$stadiums->readOne();

if ($stadiums->name != null) {
    // Validar dados
    $name = filter_var($data->name,FILTER_SANITIZE_STRING);
    $logo_stadium = filter_var($data->logo_stadium,FILTER_SANITIZE_STRING);
    $capacity = filter_var($data->capacity,FILTER_SANITIZE_NUMBER_INT);
    $city = filter_var($data->city,FILTER_SANITIZE_STRING);
    $foundation =filter_var($data->foundation,FILTER_SANITIZE_STRING);
    $grass_type = filter_var($data->grass_type,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
   
    $error = '';
    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($logo_stadium == '') {
        $error .= 'logo_stadium não definida. ';
    }
    if ($capacity == '') {
        $error .= 'capacity não definido.';
    }
    if ($city == '') {
        $error .= 'city não definido.';
    }
    if ($foundation == '') {
        $error .= 'foundation não definidas. ';
    }
    if ($grass_type == '') {
        $error .= 'grass_type não definido. ';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definido. ';
    }
    

    if ($error == '') {
        
        $stadiums->name = $name;
        $stadiums->logo_stadium = $logo_stadium;
        $stadiums->foundation =date('Y-m-d',strtotime($foundation));
        $stadiums->capacity = $capacity;                        
        $stadiums->grass_type = $grass_type;
        $stadiums->city = $city;
        $stadiums->idcountry = $idcountry;

        // Atualizar produto
        if ($stadiums->update()) {
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
