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

if (!empty($data)) {
    // Validar dados
    $users->email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
    $users->password = filter_var($data->password, FILTER_SANITIZE_STRING);
    $error = '';
    if ($users->password == '') {
        $error .= 'Password não definida. ';
    }
    if ($users->email == '') {
        $error .= 'Email não definido. ';
    }
    if (!$users->emailExists()) {
        $error .= 'Email não existe. ';
    }

    if ($error == '') {
        if (password_verify($data->password, $users->password)) {
            // Criar token
            $token = array(
                "iss" =>$iss,
                "jti"=>$jti,
                "iat"=>$iat,
                "nbf"=>$nbf,
                "exp" =>$exp,
                "data"=>array(
                    "id"=>$users->id,
                    "username" =>$users->username,
                    "email"=>$users->email
                )
            );
            // Sucesso na autenticação - 200 OK
            http_response_code(200);
            $jwt = JWT::enconde($token,$key);
            echo json_encode(
                    array(
                        "message"=>"Autenticado com sucesso",
                        "jwt"=>$jwt
                    ) 
            );
            
        } else {
            // Erros no pedido - 503 service unavailable
            http_response_code(401);
            // Enviar resposta com mensagens de erro
            echo json_encode(array("message" => 'Erro de autenticação.'));
        }
    } else {
        // Erros no pedido - 400 bad request
        http_response_code(400);
        // Enviar resposta com mensagens de erro
        echo json_encode(array("message" => $error));
    }
} else {
    // Erros no pedido - 400 bad request
    http_response_code(400);
    echo json_encode(array("message" => 'Pedido sem informação'));
}    