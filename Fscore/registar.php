<?php
define('DESC', 'Regista a tua Conta');
define('UC', 'Favoritos');
define('AUTHOR', 'Andre');
$html = '';

require_once './config.php';
$pdo = connectDB($db_web);


// Obter dados do Formulário
$register = filter_input(INPUT_POST, 'register');
if ($register) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password_hash_db = password_hash($password, PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  

    $errors = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $html .= '<div class="alert-danger">O email não é válido.</div>';
        $errors = true;
    }
    if ($username == '') {
        $html .= '<div class="alert-danger">Tem que definir um username.</div>';
        $errors = true;
    }

    if (strlen($password) < 8) {
        $html .= '<div class="alert-danger">Palavra-passe tem menos de 8 caracteres.</div>';
        $errors = true;
    }
    
    $sql = "SELECT id FROM users WHERE email = :EMAIL LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":EMAIL", $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $html .= '<div class="alert-danger">O email indicado já se encontra registado.</div>';
        $errors = true;
    }

    if (!$errors) {
        $registo = '<a class="dropdown-item" href="login.php">Iniciar Sessão</a>';
        $html .= '<div class="alert alert-info"><strong>Seja bem vindo! '.$username.' ao Fscore </strong></div>';
        $sql = "INSERT INTO users(username,email,password,photo_user) VALUES(:USERNAME,:EMAIL,:PASSWORD,:PHOTO_USER)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":USERNAME", $username, PDO::PARAM_STR);
        $stmt->bindValue(":EMAIL", $email, PDO::PARAM_STR);
        $stmt->bindValue(":PASSWORD", $password_hash_db, PDO::PARAM_STR);
        $stmt->bindValue(":PHOTO_USER", 'no_user.png', PDO::PARAM_STR);
        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $html .= '<div class="alert-success">Registo completado com sucesso. '
                    . ' Inicia a tua sessão!!</div>';
            
        } else {
            $html .= '<div class="alert-danger">Erro ao inserir na Base de Dados.</div>';
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
                    <button class="btn btn-primary" id="botao_pesquisa">
                        <img src="./logotipos/icons/pesquisa1.png" width="25" alt="icon_pesquisa" id="icon_pesquisa"/>
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
        <!--cima nav-->
       
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4"id="perfil_registar">
                    <div id="col_login">
                        <img src="./logotipos/icons/avatar2.png" width="100"/><br /><br>
                        <p id="txt_frase"><?= '<core id="core_text">'.DESC.'</core>' ?> adiciona e gere  os teus <br/> <?='<core id="core_text">'. UC .'</core>'?> em todos os teus dispositivos</core></p>
                    </div>
                    <div><?= $html ?></div>
                    <form action="?" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Endereço de Email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nome de utilizador">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Palavra-Passe">
                        </div><br />
                        <div class="card" id="b_card">
                            <button type="submit" class="btn btn-primary" name="register" value="Registar" id="button_registar" >
                                Registar conta
                            </button>
                        </div>
                    </form><br/>
                    <h6 id="regista_nova_sessao">
                            Criaste nova conta? Já podes iniciar a tua sessão!!
                    </h6>
                    <div class="card" id="b_card">
                    <div class="card" id="b_card">
                        <a class="btn btn-secondary" href="login.php" id="button_registar_login">Iniciar a Sessão</a>
                    </div><br/>
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
                <a class="navbar-brand"  href="index.php?m=competicoes&a=ligas">
                    <!-- botao 2-->
                    <img src="./logotipos/icons/leagues.png" alt="ligas" id="img_competicoes" />
                </a>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" id="botao_baixo_3">
                <a class="navbar-brand" href="index.php?m=favoritos&a=favoritos">
                    <!-- botao 3-->
                    <img src="./logotipos/icons/favoritos.png" alt="favorites" id="img_favoritos" />
                </a>
            </button>
        </navbar>
    </body>    
</html>