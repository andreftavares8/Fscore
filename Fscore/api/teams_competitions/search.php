<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Teams_Competitions.php';
$teams_competitions = new Teams_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $teams_competitions->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $teams_competitions_arr = array();
        $teams_competitions_arr["teams competitions"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $teams_competitions_item = array(

                "season" => $row['season'],
                "idcompetition" => $row['idcompetition'],
                "name_competition" => $row['name_competition'],
                "logo_competition"=>$row['logo_competition'],
                "competition_type"=>$row['competition_type'],
                "logo_federation" => $row['logo_federation'],
                "logo_trophie" => $row['logo_trophie'],
                "idteam"=>$row['idteam'],
                "nickname_team"=>$row['nickname_team'],
                "logo_team"=>$row['logo_team'],
                "competition_group" => $row['competition_group'],
                "competition_colectivo" => $row['competition_colectivo'],
                "idcountry" => $row['idcountry'],
                "name_country" => $row['name_country'],
                "flag_country" => $row['flag_country']

            );
            array_push($teams_competitions_arr["teams competitions"], $teams_competitions_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($teams_competitions_arr);
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

