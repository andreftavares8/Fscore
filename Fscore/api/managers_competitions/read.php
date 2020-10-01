<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Managers_Competitions.php';
$managers_competitions = new Managers_Competitions($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $managers_competitions->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $managers_competitions_arr = array();
    $managers_competitions_arr["managers competitions"] = array();
    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $managers_competitions_item = array(

            "season" => $row['season'],
            "idcompetition" => $row['idcompetition'],
            "name_competition" => $row['name_competition'],
            "logo_competition"=>$row['logo_competition'],
            "competition_type"=>$row['competition_type'],
            "logo_federation" => $row['logo_federation'],
            "logo_trophie" => $row['logo_trophie'],
            "idmanager"=>$row['idmanager'],
            "nickname_manager"=>$row['nickname_manager'],
            "photo_manager"=>$row['photo_manager'],
            "colectivo_competition" => $row['colectivo_competition'],
            "individual_competition" => $row['individual_competition'],
            "idcountry" => $row['idcountry'],
            "name_country" => $row['name_country'],
            "flag_country" => $row['flag_country']
     
        );
        array_push($managers_competitions_arr["managers competitions"], $managers_competitions_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($managers_competitions_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}