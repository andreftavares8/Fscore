<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }
//sessao iniciada
session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

//Carregar Classe
require_once './objects/Favorites_Players.php';
// Criar objeto da Classe
$fav_play = new Favorites_Players($pdo);

/*******************************
 * vindo da pagina jogador
 * ***************************** */
$idplayer = filter_input(INPUT_GET, 'idplayer');
$namep = filter_input(INPUT_GET, 'namep');
$nameplay = filter_input(INPUT_GET, 'nameplay');
if ($idplayer) {
    echo'aqui';
    // Verificar dados
    $idplayer = filter_var($idplayer, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameplay = filter_var($nameplay,FILTER_SANITIZE_STRING);
    $iduser = filter_var($_SESSION['uid'],FILTER_SANITIZE_NUMBER_INT);
    $errors = false;
    if ($idplayer == '') {
        $errors = true;
    }
    if ($iduser == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_play->iduser = $iduser;
        $fav_play->idplayer = $idplayer;
        
    
        // Criar produto
        if ($fav_play->create()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=jogadores&'.$namep.'&a=jogador&'.$nameplay.'&id='.$idplayer.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
} 