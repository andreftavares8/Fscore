<?php
session_start();


if(!isset($_SESSION['uid'])){
    session_destroy();
    $htmlsessao ='<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="itens_perfil">
                            <a class="dropdown-item" href="login.php">Iniciar Sessão</a>
                            <a class="dropdown-item" href="registar.php">Registar Conta</a>
                        </div>';
    $html_favoritos = '';
    $html_photo = '<img src="./logotipos/icons/avatar2.png" alt="photo_perfil" id="photo_perfil">';
}else{
    $htmlsessao='<div class="dropdown-menu" aria-labelledby="navbarDropdown" id="itens_perfil">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="logout.php">Encerrar Sessão</a>
                        </div>';
    $html_favoritos = '
                    <img src="./logotipos/icons/favoritos.png" alt="icon de favoritos" id=icon_favoritos>';
    $fav_noti = isset($notificacoes) ? '<span class="badge badge-light" id="botao_notificacao">9</span>
    <span class="sr-only">unread messages</span>' :'';
                    
    $html_photo = '<img src="./logotipos/icons/'.$_SESSION['photo_user'].'" alt="photo_perfil" id="photo_perfil">';

}   

require_once './config.php';
$pdo = connectDB($db_web);

// Carregar módulo ativo
$module = filter_input(INPUT_GET, "m",FILTER_SANITIZE_STRING);

// Validar módulo ativo
$module = validateModule($module, $modules)?$module:'fscore';

// Carregar ação
$action= filter_input(INPUT_GET, 'a',FILTER_SANITIZE_STRING);

// Testar se existe ficheiro a carregar. caso contrário carregar HOME
if (!file_exists("./$module/$action.php")){
   $module = 'encontros';
    $action = 'encontros-do-dia';
}


// Carregar menu
$main_menu = loadMenu($modulo, $modules);

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
        <link href="./common/css/bootstrap.min.css" rel="stylesheet">
        <link href="./common/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="./common/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
            integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
            
        
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
                    <?= $main_menu . $html_favoritos . $fav_noti?>
                </ul>
            </div>
            <div id="form_pesquisa_pos">
                <form class="form-inline" action="?m=pesquisas&a=pesquisa" method="POST" id="form_pesquisa">
                    <input class="form-control" name="pesquisa" type="text" placeholder=" Pesquisa ..." aria-label="Search"
                        id="input_pesquisa" color="blue">
                    <button class="btn btn-primary" name="submeter" value="submeter" type="submit" id="botao_pesquisa">
                        <img src="./logotipos/icons/pesquisa1.png" width="25" alt="icon_pesquisa" id="icon_pesquisa" />
                    </button>
                </form>
            </div>
            <div class="dropdown" id="menu_perfil">
                <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="user"><?= $_SESSION['username']?$_SESSION['username']:"Inicia a Sessão"?></span>&nbsp
                        <?= $html_photo ?>
                </a>
                    <?= $htmlsessao?>
            </div>
        </nav>
        <!-- cima nav-->
        
        <!-- div todo corpo-->
        <div class="container">

            <div><?php @require_once "$module/$action.php"; ?>
            </div>
           
            <div class="fixed-bottom bg-light"></div>
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
                    <!-- botao 3 -->
                    <img src="./logotipos/icons/favoritos.png" alt="favorites" id="img_favoritos" />
                </a>
            </button>
        </navbar>
        
        	
    </body>
    <script src="./common/css/bootstrap.min.js" rel="stylesheet"></script>
        <script src="./common/js/bootstrap-datetimepicker.min.js"></script>
        <script src="./common/js/bootstrap-datetimepicker.pt.js"></script>
   <script>


        $(document).ready(function(){
            $('#form_pesquisa').keyup(function( event ){
                event.preventDefault();
                var pesquisa =$(this).val();

                if(pesquisa != ''){
                    var dados = {
                        palavra : pesquisa
                    }
                    $.post("pesquisas/pesquisa.php",dados,function(retorna){
                        $(".container").html(retorna);
                    });
                }
            });
            /*$("#input_pesquisa" ).keyup(function( event ) {
                console.log("qsasa");
                $('#form_pesquisa').trigger('submit');

                }).keydown(function( event ) {
                    console.log("qsasa");
                if ( event.which == 13 ) {
                    console.log("enter");
                    event.preventDefault();
                }
                });
                $("#form_pesquisa").on('submit', function( event ){

                    event.preventDefault();console.log($("#input_pesquisa").val());
                    $.ajax({
                        method: "post",
                        url: "pesquisas/pesquisa.php",
                        data:  $("#form_pesquisa").serialize(),
                        context: document.body
                    }).done(function(e) {
                        
                    $(".container" ).html(e);
                });

                });*/
                // data
            $('.data_formato').datetimepicker({
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight:1,
                startView:2,
                forceParse:0,
                minView:3,
               language: "pt"
            });
            $('.data_formato').change(function(event) {
                event.preventDefault();
                $("#button-submit-encontro").trigger( "click" );
            })

            /* info de problabilidades*/
            if($('#info_row').show()){
                $('#info_row').siblings('#info_row_prob').hide();
                $('#minimizar').hide();
                $('#mostrar_mais').click(function(event){
                    event.preventDefault();
                    $('#info_row').siblings('#info_row_prob').show();
                    $('#minimizar').show();
                
                });
                $('#minimizar').click(function(event){
                    event.preventDefault();
                    $('#info_row').siblings('#info_row_prob').hide();
                    $('#minimizar').hide();
                
                });

            }
           
            /****************************************
            * para os encontros
            *******************************************//*
            $('#paises_encontros_sty').siblings('#competicoes_encontros_sty').hide();
            $('#paises_encontros_sty').siblings('#equipas_encontros_sty').hide();
            $('#jogos_encontros_sty').click(function(event){
                event.preventDefault();
                $(this).siblings('#competicoes_encontros_sty').toggle();
                $(this).siblings('#equipas_encontros_sty').toggle();

                
            });
            $('#paises_encontros_sty').click(function(event){
                event.preventDefault();
                $(this).siblings('#competicoes_encontros_sty').toggle();
                //paises_encontros
                
            });
            $('#competicoes_encontros_sty').click(function(event){
                event.preventDefault();
                $(this).siblings('#equipas_encontros_sty').toggle();
                //competicoes_encontros
                $('#competicoes_encontros_sty').click(function(event){
                    event.preventDefault();
                    $('#paises_encontros').on('click',function(){ 

        var taskid = $(this).parent().parent().attr('id');
                })
            });    
            */
            
        });
       

        </script>
</html>