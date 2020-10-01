<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }
//sessao iniciada
session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

//Carregar Classe
require_once './objects/Favorites_Competitions.php';
// Criar objeto da Classe
$fav_comp = new Favorites_Competitions($pdo);

/*******************************
 * vindo da pagina torneio
 * ***************************** */
$idcomp = filter_input(INPUT_GET, 'idcomp');
$namep = filter_input(INPUT_GET, 'namep');
$namefed = filter_input(INPUT_GET, 'namefed');
$namecomp = filter_input(INPUT_GET, 'namecomp');
if ($idcomp) {
    
    // Verificar dados
    $idcompetition = filter_var($idcomp, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $namefed = filter_var($namefed,FILTER_SANITIZE_STRING);
    $namecomp = filter_var($namecomp,FILTER_SANITIZE_STRING);
    $iduser = filter_var($_SESSION['uid'],FILTER_SANITIZE_NUMBER_INT);
    $errors = false;
    if ($idcompetition == '') {
        $errors = true;
    }
    if ($iduser == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_comp->iduser = $iduser;
        $fav_comp->idcompetition = $idcompetition;
        
    
        // Criar produto
        if ($fav_comp->create()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=competicoes&'.$namep.'&'.$namefed.'&a=torneio&'.$namecomp.'&id='.$idcomp.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
}

echo $html;
