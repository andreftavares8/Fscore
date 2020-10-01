<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Players_Competitions.php';
$players_competitions = new Players_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));

//obter keywords
$keywords = filter_var($data->s,FILTER_SANITIZE_STRING);

if (!empty($keywords)) {
// Pesquisar
    $stmt = $players_competitions->search($keywords);
    $num = $stmt->rowCount();

    // Verificar se existem resultados
    if ($num > 0) {
        // products array
        $players_competitions_arr = array();
        $players_competitions_arr["players competitions"] = array();

        // Obter registos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $players_competitions_item = array(

                "season" => $row['season'],
                "idcompetition" => $row['idcompetition'],
                "name_competition" => $row['name_competition'],
                "logo_competition"=>$row['logo_competition'],
                "competition_type"=>$row['competition_type'],
                "logo_federation" => $row['logo_federation'],
                "logo_trophie" => $row['logo_trophie'],
                "idplayer"=>$row['idplayer'],
                "nickname_player"=>$row['nickname_player'],
                "photo_player"=>$row['photo_player'],
                "colectivo_competition" => $row['colectivo_competition'],
                "individual_competition" => $row['individual_competition'],
                "idcountry" => $row['idcountry'],
                "name_country" => $row['name_country'],
                "flag_country" => $row['flag_country']

            );
            array_push($players_competitions_arr["players competitions"], $players_competitions_item);
        }
        // Definir resposta - 200 OK
        http_response_code(200);
        // Enviar resposta
        echo json_encode($players_competitions_arr);
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

