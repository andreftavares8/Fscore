<?php

// Carregar configurações
require_once '../../config.php';
$pdo = connectDB($db_web);
// Carregar classe
require_once '../../objects/Users.php';
$users = new Users($pdo);

// Carregar JWT
require_once '../../common/php-jwt-master/src/BeforeValidException.php';
require_once '../../common/php-jwt-master/src/ExpiredException.php';
require_once '../../common/php-jwt-master/src/SignatureInvalidException.php';
require_once '../../common/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;

// Definição do cabeçalho
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, "
        . "Access-Control-Allow-Headers, "
        . "Authorization, X-Requested-With");

// Obter dados do POST
$data = json_decode(file_get_contents("php://input"));
$users->username = filter_var($data->username, FILTER_SANITIZE_STRING);
$users->password = filter_var($data->password, FILTER_SANITIZE_STRING);
$users->email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
$users->photo_user = filter_var($data->photo_user, FILTER_SANITIZE_STRING);
// Obter JWT
$jwt = isset($data->jwt) ? $data->jwt : "";
if ($jwt) {
    try {
        // Decode do JWT
        $decoded = JWT::decode($jwt,$key,array('HS256'));
        // Definição do ID de utilizador
        $users->id= filter_var($decode->data->id,FILTER_SANITIZE_NUMBER_INT);
        // Atualizar
        if ($users->update()) {
            // Gerar novo token
            $token = array(
                "iss"=>$iss,
                "jti" =>$jti,
                "nbf"=>$nbf,
                "exp" => $exp,
                "data"=>array(
                    "id"=>$users->id,
                    "username"=>username,
                    "email"=>$users->email,
                    "photo_user"=>$users->photo_user
                )
            );
            // Sucesso na operação - 200 OK
            http_response_code(200);
            $jwt = JWT::encode($token, $key);
            echo json_encode(array(
                "message"=>"atualizado com sucesso",
                "jwt"=>$jwt
                )
            );
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(503);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message" => 'Erro ao atualizar.'));
        }
    } catch (Exception $e) {
        // Acesso negado - 401 Unauthorized
        http_response_code(401);
        echo json_encode(array(
            "message" => "Acesso negado.",
            "error" => $e->getMessage()
        ));
    }
} else {
    // Acesso negado - 401 Unauthorized
    http_response_code(401);
    echo json_encode(array("message" => 'Acesso negado'));
}