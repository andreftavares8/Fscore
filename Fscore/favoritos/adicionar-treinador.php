<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }
//sessao iniciada
session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

//Carregar Classe
require_once './objects/Favorites_Managers.php';
// Criar objeto da Classe
$fav_play = new Favorites_Managers($pdo);

/*******************************
 * vindo da pagina treinador
 * ***************************** */
$idmanager = filter_input(INPUT_GET, 'idmanager');
$namep = filter_input(INPUT_GET, 'namep');
$nameman = filter_input(INPUT_GET, 'nameman');
if ($idmanager) {
    // Verificar dados
    $idmanager = filter_var($idmanager, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameman = filter_var($nameman,FILTER_SANITIZE_STRING);
    $iduser = filter_var($_SESSION['uid'],FILTER_SANITIZE_NUMBER_INT);
    $errors = false;
    if ($idmanager == '') {
        $errors = true;
    }
    if ($iduser == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_play->iduser = $iduser;
        $fav_play->idmanager = $idmanager;
        
    
        // Criar produto
        if ($fav_play->create()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=treinadores&'.$namep.'&a=treinador&'.$nameman.'&id='.$idmanager.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
} 