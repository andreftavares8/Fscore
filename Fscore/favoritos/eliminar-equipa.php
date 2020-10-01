<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Favorites_teams.php';
// Criar objeto da Classe
$fav_team = new Favorites_teams($pdo);


/**********************
 * vindo da pagina jogo
 * **********************/

$idfav = filter_input(INPUT_GET, 'idfav');
$namep = filter_input(INPUT_GET, 'namep');
$nameteam_h = filter_input(INPUT_GET, 'nameteam_h');
$nameteam_a = filter_input(INPUT_GET, 'nameteam_a');
$idjogo = filter_input(INPUT_GET, 'idjogo');

if ($idfav) {
    
    // Verificar dados
    $id = filter_var($idfav, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep,FILTER_SANITIZE_STRING);
    $nameteam_h = filter_var($nameteam_h, FILTER_SANITIZE_STRING);
    $nameteam_a = filter_var($nameteam_a,FILTER_SANITIZE_STRING);
    $idjogo = filter_var($idjogo,FILTER_SANITIZE_NUMBER_INT);
    
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_team->id=$id;
        // elimiar favorito
        if ($fav_team->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m=encontros&'.$namep.'&a=jogo&'.$nameteam_h.'-'.$nameteam_a.'&id='.$idjogo.'');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
/******************
 * vindo da pagina favoritos
 * *************************** */
$idfav_fav = filter_input(INPUT_GET, 'idfav_fav');
$namep = filter_input(INPUT_GET, 'namep');
$nameteam = filter_input(INPUT_GET, 'nameteam');
if ($idfav_fav) {

    // Verificar dados
    $id = filter_var($idfav_fav, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameteam = filter_var($nameteam, FILTER_SANITIZE_STRING);
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_team->id=$id;
        // elimiar favorito
        if ($fav_team->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m='.$module.'&a=favoritos');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
/********************************
 * vindo da pagina equipa
 * *************************** */

$idfav_equi = filter_input(INPUT_GET, 'idfav_equi');
$idteam = filter_input(INPUT_GET, 'idteam');
$namep = filter_input(INPUT_GET, 'namep');
$nameteam = filter_input(INPUT_GET, 'nameteam');
if ($idfav_equi) {

    // Verificar dados
    $id = filter_var($idfav_equi, FILTER_SANITIZE_NUMBER_INT);
    $idteam = filter_var($idteam,FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameteam = filter_var($nameteam,FILTER_SANITIZE_STRING);
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_team->id=$id;
        // elimiar favorito
        if ($fav_team->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m=equipas&'.$namep.'&a=equipa&'.$nameteam.'&id='.$idteam.'');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
echo $html;
