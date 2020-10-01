<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Favorites_Managers.php';
// Criar objeto da Classe
$fav_man = new Favorites_Managers($pdo);

/****************************
 * vindo da pagina favoritos 
 * *************** */
$idfav = filter_input(INPUT_GET, 'idfav');
$namep = filter_input(INPUT_GET, 'namep');
$nameman = filter_input(INPUT_GET, 'nameman');
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
        
        $fav_man->id=$id;
        // elimiar favorito
        if ($fav_man->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m='.$module.'&a=favoritos');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
/************************
 * vindo da pagina treinaador
 * ******************* */
$idfav_man = filter_input(INPUT_GET, 'idfav_man');
$idman = filter_input(INPUT_GET, 'idman');
$namep = filter_input(INPUT_GET, 'namep');
$nameman = filter_input(INPUT_GET, 'nameman');
if ($idfav_man) {
    
    // Verificar dados
    $id = filter_var($idfav_man, FILTER_SANITIZE_NUMBER_INT);
    $idman = filter_var($idman,FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameman = filter_var($nameman, FILTER_SANITIZE_STRING);
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_man->id=$id;
        // elimiar favorito
        if ($fav_man->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m=treinadores&'.$namep.'&a=treinador&'.$nameman.'&id='.$idman.'');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
echo $html;
