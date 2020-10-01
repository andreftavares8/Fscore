<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Countries.php';
$countries = new Countries($pdo);

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
$countries->id= $id;
$countries->readOne();

if ($countries->name != null) {
    // Validar dados
    $name = filter_var($data->name,FILTER_SANITIZE_STRING);
    $flag_country = filter_var($data->flag_country,FILTER_SANITIZE_STRING);
       
    $error = '';

    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($flag_country == '') {
        $error .= 'flag_country não definido. ';
    }
    

    if ($error == '') {
        $countries->name = $name;
        $countries->flag_country = $flag_country;
        

        // Atualizar produto
        if ($countries->update()) {
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
