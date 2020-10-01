<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Favorites_Competitions.php';
// Criar objeto da Classe
$fav_comp = new Favorites_Competitions($pdo);

/***************************
 * vindo da pagina favoritos
 * ********************* */
$idfav = filter_input(INPUT_GET, 'idfav');
$namep = filter_input(INPUT_GET, 'namep');
$nameplay = filter_input(INPUT_GET, 'nameplay');
if ($idfav) {
    
    // Verificar dados
    $id = filter_var($idfav, FILTER_SANITIZE_NUMBER_INT);
    
    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        
        $fav_comp->id=$id;
        // elimiar favorito
        if ($fav_comp->delete()) {
            $html .= 'Eliminado dos Favoritos';
            header('Location: ?m='.$module.'&a=favoritos');
            
        }else {
            $html .= 'Não foi possível eliminar Produto';
        }
    }
}
/*******************************
 * vindo da pagina torneio
 * ***************************** */
$idfav_comp = filter_input(INPUT_GET, 'idfav_comp');
$idcomp = filter_input(INPUT_GET, 'idcomp');
$namep = filter_input(INPUT_GET, 'namep');
$namefed = filter_input(INPUT_GET, 'namefed');
$namecomp = filter_input(INPUT_GET, 'namecomp');

if ($idfav_comp) {
    
    // Verificar dados
    $id = filter_var($idfav_comp, FILTER_SANITIZE_NUMBER_INT);
    $idcomp = filter_var($idcomp, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep,FILTER_SANITIZE_STRING);
    $namefed = filter_var($namefed,FILTER_SANITIZE_STRING);
    $namecomp = filter_var($namecomp,FILTER_SANITIZE_STRING);

    $errors = false;
    if ($id == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_comp->id=$id;
        
    
        // Criar produto
        if ($fav_comp->delete()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=competicoes&'.$namep.'&'.$namefed.'&a=torneio&'.$namecomp.'&id='.$idcomp.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
} 

echo $html;
