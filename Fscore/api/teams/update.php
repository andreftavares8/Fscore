<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams.php';
$teams = new Teams($pdo);

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
$teams ->id= $id;
$teams->readOne();

if ($teams->nickname != null) {
    // Validar dados
    $name = filter_var($data->name,FILTER_SANITIZE_STRING);
    $nickname = filter_var($data->nickname,FILTER_SANITIZE_STRING);
    $city = filter_var($data->city,FILTER_SANITIZE_STRING);
    $foundation = filter_var($data->foundation,FILTER_SANITIZE_STRING);
    $president = filter_var($data->president,FILTER_SANITIZE_STRING);
    $logo_team =filter_var($data->logo_team,FILTER_SANITIZE_STRING);
    $logo_kit_home = filter_var($data->logo_kit_home,FILTER_SANITIZE_STRING);
    $logo_kit_away = filter_var($data->logo_kit_away,FILTER_SANITIZE_STRING);
    $idcountry = filter_var($data->idcountry,FILTER_SANITIZE_NUMBER_INT);
    $idstadium = filter_var($data->idstadium,FILTER_SANITIZE_NUMBER_INT);
   
    $error = '';
    if ($name == '') {
        $error .= 'name não definido. ';
    }
    if ($nickname == '') {
        $error .= 'nickname não definido. ';
    }
    if ($city == '') {
        $error .= 'city não definido.';
    }
    if ($foundation == '') {
        $error .= 'foundation não definido.';
    }
    if ($president == '') {
        $error .= 'president não definidas. ';
    }
    if ($logo_team == '') {
        $error .= 'logo_team não definido. ';
    }
    if ($logo_kit_home == '') {
        $error .= 'logo_kit_home  não definido. ';
    }
    if ($logo_kit_away == '') {
        $error .= 'logo_kit_away não definido. ';
    }
    if ($idcountry == '') {
        $error .= 'idcountry não definida. ';
    }
    if ($idstadium == '') {
        $error .= 'idstadium não definido. ';
    }
    

    if ($error == '') {
        $teams->name = $name;
        $teams->nickname = $nickname;
        $teams->city = $city;
        $teams->foundation =date('Y-m-d',strtotime($foundation));
        $teams->president =$president;
        $teams->logo_team = $logo_team;
        $teams->logo_kit_home = $logo_kit_home;
        $teams->logo_kit_away = $logo_kit_away;
        $teams->idcountry = $idcountry;
        $teams->idstadium = $idstadium;

        // Atualizar produto
        if ($teams->update()) {
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
