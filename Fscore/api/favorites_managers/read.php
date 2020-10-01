<?php
// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Favorites_Managers.php';
$favorites_managers = new Favorites_Managers($pdo);

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json; charset=UTF-8");

// Obter produtos
$stmt = $favorites_managers->read();
$num = $stmt->rowCount();

if ($num > 0) {
    // Array de produtos
    $favorites_managers_arr = array();
    $favorites_managers_arr["treinadores favoritos"] = array();
    
    // Obter registos
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $favorites_managers_item = array(
            "iduser" => $row['iduser'],
            "name_user" => $row['name_user'],
            "idmanager" => $row['idmanager'],
            "nickname_manager" => $row['nickname_manager'],
            "photo_manager" => $row['photo_manager'],
            "country_name" => $row['country_name'],
            "flag_country" => $row['flag_country']
           
        );

        array_push($favorites_managers_arr["treinadores favoritos"], $favorites_managers_item);
    }
    // Definir resposta - 200 OK
    http_response_code(200);
    // Enviar resposta
    echo json_encode($favorites_managers_arr);
} else {
    // Não encontrou produtos - 404 Not found
    http_response_code(404);
    // Enviar resposta
    echo json_encode(array("message"=>"Sem registos"));

}