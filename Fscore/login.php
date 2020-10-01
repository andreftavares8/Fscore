<?php
session_start();


define('DESC', 'Inicia a tua Sessão');
define('UC', 'Favoritos');
define('AUTHOR', 'André');
$html = '';

require_once './config.php';
$pdo = connectDB($db_web);




$login = filter_input(INPUT_POST, 'login');
if ($login) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password_hash_db = password_hash($password, PASSWORD_DEFAULT);

    $errors = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $html .= '<div class="alert-danger">O email não é válido.</div>';
        $errors = true;
    }
    $sql = "SELECT * FROM users WHERE email = :EMAIL LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":EMAIL", $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() != 1) {
        $html .= '<div class="alert-danger">O email indicado não se encontra registado.</div>';
        $errors = true;
    } else if (!$errors) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($password, $row['password'])) {
            $html .= '<div class="alert-danger">Palavra-passe incorreta.</div>';
        } else {
            $_SESSION['uid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['photo_user'] = $row['photo_user'];
            //$html .= '<div class="alert-success">Seja bem-vindo <b>'.$_SESSION['username'].'</b></div>';
            //$html.='<div><a class="btn btn-primary" href="main.php">Continuar</a> ';
            //$html.='<a class="btn btn-secondary" href="logout.php">Logout</a></div>';
            header('Location: index.php');
            exit();
        }
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Fscore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./logotipos/icons/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./logotipos/icons/favicon.ico" type="image/x-icon">
        <link href="./common/css/_css.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="pagina_corpo">
        <nav class="navbar navbar-expand-lg navbar-light" id="menu_top">
            <a class="navbar-brand" href="index.php">
                <img src="./logotipos/icons/logo1_launcher-web.png" alt="logo"id="img_logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                id="botao_escondido">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <a id="txt_menu" class="nav-link" href="index.php?m=encontros&a=encontros-do-dia">Fscore </a>
                    <a id="txt_menu" class="nav-link" href="index.php?m=competicoes&a=ligas">Competições </a>
                    <a id="txt_menu" class="nav-link" href="index.php?m=favoritos&a=favoritos">Favoritos </a>
                </ul>
            </div>
            <div id="form_pesquisa_pos">
                <form class="form-inline" action="/action_page.php" id="form_pesquisa">
                    <input class="form-control " type="search" placeholder=" Pesquisa ..." aria-label="Search"
                        id="input_pesquisa" color="blue">
                    <button class="btn btn-primary " type="submit" id="botao_pesquisa">
                        <img src="./logotipos/icons/pesquisa1.png" width="25" alt="icon_pesquisa" id="icon_pesquisa" />
                    </button>
                </form>
            </div>
            <div class="dropdown" id="menu_perfil">
                <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="user"><?= $_SESSION['username']?$_SESSION['username']:"Inicia a Sessão"?></span>&nbsp
                        <img src="./logotipos/icons/avatar2.png" width="35" alt="icon de perfil" id="photo_perfil"/>
                        
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="itens_perfil">
                    <a class="dropdown-item" href="login.php">Iniciar Sessão</a>
                    <a class="dropdown-item" href="registar.php">Registar Conta</a> 
            </div>
        </nav>
        <!-- cima nav-->

        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4"id="perfil_login">
                    <div id="col_login">
                        <img src="./logotipos/icons/avatar2.png" width="100"/><br/><br> 
                        <p id="txt_frase"><?= '<core id="core_text">'.DESC.'</core>'?> e gere  os teus <br/><?= '<core id="core_text">'. UC .'</core>'?> em todos os teus dispositivos</core></p>
                    </div>
                    <div><?= $html ?></div>
                    <form action="?" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Endereço de Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Palavra-Passe" >
                        </div>
                        <div class="form-group">
                            <a class="link"  href="#" id="esq_pass">Esqueceste da Palavra-Passe?</a>
                        </div>
                        <div class="card" id="b_card">
                            <button type="submit" class="btn btn-primary" name="login" value="login" id="button_login" >
                                Iniciar Sessão
                            </button>
                        </div>
                    </form><br/><br/>
                    <h6 id="cria_nova_conta">
                            Não Tem conta?Cria uma nova conta!!
                        </h6>
                    <div class="card" id="b_card">
                        <a class="btn btn-secondary" href="registar.php" id="button_login_registar">Registar nova conta</a>
                    </div><br/><br/>
                </div>
                
            </div>
        </div>

        <!-- parte de baixo nav-->
        <navbar class="navbar navbar-expand-md navbar-dark fixed-bottom justify-content-center" id="menu_baixo">

            <button class="navbar-toggler" type="button" data-toggle="collapse" id="botao_baixo_1">
                <a class="navbar-brand" href="index.php?m=encontros&a=encontros-do-dia">
                    <!-- botao 1-->
                    <img src="./logotipos/icons/stadium.png" alt="estadio" id="img_encontros" />
                </a>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" id="botao_baixo_2">
                <a class="navbar-brand" href="index.php?m=competicoes&a=ligas">
                    <!-- botao 2-->
                    <img src="./logotipos/icons/leagues.png" alt="ligas" id="img_competicoes" />
                </a>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" id="botao_baixo_3">
                <a class="navbar-brand" href="index.php?m=favoritos&a=favoritos">
                    <!-- botao 3 -->
                    <img src="./logotipos/icons/favoritos.png" alt="favorites" id="img_favoritos" />
                </a>
            </button>
        </navbar>
    </body>
</html>
