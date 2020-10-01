<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Favorites_Players.php';
// Criar objeto da Classe
$fav_play = new Favorites_Players($pdo);

/****************************
 * vindo da pagina favoritos 
 * *************** */
$idfav = filter_input(INPUT_GET, 'idfav');
$namep = filter_input(INPUT_GET, 'namep');
$nameplay = filter_input(INPUT_GET, 'nameplay');
if ($idfav) {
    
    // Verificar dados
    $id = filter_var($idfav, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep,FILTER_SANITIZE_STRING);
    $nameplayer = filter_var($nameteam_h, FILTER_SANITIZE_STRING);
    
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_play->id=$id;
        // elimiar favorito
        if ($fav_play->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m='.$module.'&a=favoritos');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
/************************
 * vindo da pagina jogador
 * ******************* */
$idfav_play = filter_input(INPUT_GET, 'idfav_play');
$idplay = filter_input(INPUT_GET, 'idplay');
$namep = filter_input(INPUT_GET, 'namep');
$nameplay = filter_input(INPUT_GET, 'nameplay');
if ($idfav_play) {
    
    // Verificar dados
    $id = filter_var($idfav_play, FILTER_SANITIZE_NUMBER_INT);
    $idplay = filter_var($idplay,FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameplay = filter_var($nameplay, FILTER_SANITIZE_STRING);
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_play->id=$id;
        // elimiar favorito
        if ($fav_play->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m=jogadores&'.$namep.'&a=jogador&'.$nameplay.'&id='.$idplay.'');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
echo $html;
