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

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $favorites_teams->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $favorites_teams_arr = array();
        $favorites_teams_arr["team favorito"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $favorites_teams_item = array(
                "iduser" => $row['iduser'],
                "name_user" => $row['name_user'],
                "idteam" => $row['idteam'],
                "nickname_team" => $row['nickname_team'],
                "logo_team" => $row['logo_team'],
                "idcountry" => $row['idcountry'],
                "country_name" => $row['country_name'],
                "flag_country" => $row['flag_country']
                
            );
            array_push($favorites_teams_arr["team favorito"], $favorites_teams_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($favorites_teams_arr);
    } else {
        // Não encontrou registos - 404 Not found
        http_response_code(404);
        // Enviar resposta
        echo json_encode(array("message"=>"nenhum registo encontrado"));
    }
} else {
    // Erros no pedido - 400 bad request
    http_response_code(400);
    // Enviar resposta
    echo json_encode(array("message"=>"Pedido sem informaçao"));
}
