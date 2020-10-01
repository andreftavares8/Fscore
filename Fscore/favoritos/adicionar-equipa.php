<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }
//sessao iniciada
session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

//Carregar Classe
require_once './objects/Favorites_teams.php';
// Criar objeto da Classe
$fav_team = new Favorites_teams($pdo);

/*******************************
 * vindo da pagina jogo
 * ***************************** */
$idteam_jogo = filter_input(INPUT_GET, 'idteam_jogo');
$namep = filter_input(INPUT_GET, 'namep');
$nameteam_h = filter_input(INPUT_GET, 'nameteam_h');
$nameteam_a = filter_input(INPUT_GET, 'nameteam_a');
$idjogo = filter_input(INPUT_GET, 'idjogo');
if ($idteam_jogo) {
    
    // Verificar dados
    $idteam = filter_var($idteam_jogo, FILTER_SANITIZE_NUMBER_INT);
    $nameteam_h = filter_var($nameteam_h, FILTER_SANITIZE_STRING);
    $nameteam_a = filter_var($nameteam_a,FILTER_SANITIZE_STRING);
    $idjogo = filter_var($idjogo,FILTER_SANITIZE_NUMBER_INT);
    $iduser = filter_var($_SESSION['uid'],FILTER_SANITIZE_NUMBER_INT);
    $errors = false;
    if ($idteam == '') {
        $errors = true;
    }
    if ($iduser == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_team->iduser = $iduser;
        $fav_team->idteam = $idteam;
        
    
        // Criar produto
        if ($fav_team->create()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=encontros&'.$namep.'&a=jogo&'.$nameteam_h.'-'.$nameteam_a.'&id='.$idjogo.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
} 
/*******************************
 * vindo da pagina equipa
 * ***************************** */
$idteam = filter_input(INPUT_GET, 'idteam');
$namep = filter_input(INPUT_GET, 'namep');
$nameteam = filter_input(INPUT_GET, 'nameteam');
if ($idteam) {
    
    // Verificar dados
    $idteam = filter_var($idteam, FILTER_SANITIZE_NUMBER_INT);
    $namep = filter_var($namep, FILTER_SANITIZE_STRING);
    $nameteam = filter_var($nameteam,FILTER_SANITIZE_STRING);
    $iduser = filter_var($_SESSION['uid'],FILTER_SANITIZE_NUMBER_INT);
    $errors = false;
    if ($idteam == '') {
        $errors = true;
    }
    if ($iduser == '') {
        $errors = true;
    }

    if (!$errors) {
        $debug .= '<p>Informação válida proceder ao registo.</p>';
        // Instanciar propriedades do objeto com valores do formulário
        $fav_team->iduser = $iduser;
        $fav_team->idteam = $idteam;
        
    
        // Criar produto
        if ($fav_team->create()) {
            $html .= 'Adicionado aos Favoritos';
            header('Location: ?m=equipas&'.$namep.'&a=equipa&'.$nameteam.'&id='.$idteam.'');
            
        }else {
            $html .= 'Não foi possível criar Produto';
        }
    }
} 

echo $html;
