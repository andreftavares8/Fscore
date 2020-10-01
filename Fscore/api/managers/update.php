<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers.php';
$managers = new Managers($pdo);

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
$managers ->id= $id;
$managers->readOne();

if ($managers->nickname != null) {
    // Validar dados
    $name = filter_var($data->name,FILTER_SANITIZE_STRING);
    $nickname = filter_var($data->nickname,FILTER_SANITIZE_STRING);
    $birth_date = filter_var($data->birth_date,FILTER_SANITIZE_STRING);
    $favorite_tatic = filter_var($data->favorite_tatic,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
    
   
    $error = '';
    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($nickname == '') {
        $error .= 'nickname não definido. ';
    }
    if ($birth_date == '') {
        $error .= 'birth_date não definido.';
    }
    if ($favorite_tatic == '') {
        $error .= 'favorite_tatic não definido.';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definidas. ';
    }
    

    if ($error == '') {
        $managers->name = $name;
        $managers->nickname = $nickname;
        $managers->birth_date =date('Y-m-d',strtotime($birth_date));
        $managers->favorite_tatic = $favorite_tatic;                        
        $managers->idcountry = $idcountry;
        

        // Atualizar produto
        if ($managers->update()) {
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
