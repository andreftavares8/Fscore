<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe

require_once './objects/Managers.php';
require_once './objects/Favorites_Managers.php';

session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';

// Criar objeto da Classe
$manager = new Managers($pdo);
$fav_man = new Favorites_Managers($pdo);
// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$manager->id=$id;

// Obter Produtos e número de registos
$manager->readOne();
$html ='
    <div class="container"><br><br>';
if ($manager->name != null) {
    $html .= '
        <div class="row">
            <div class="col-sm-2" id="team_equipa_logo">
                <img src="./logotipos/treinadores/'.$manager->photo_manager.'" id="logo_team_jogo">
            </div>
            <div class="col-sm-4" id="team_equipa">
                <img src="./logotipos/paises/'.$manager->flag_country.'" id="img_pais_flag_equipa">'
                .$manager->name_country.'<br><br>
                <p id="txt_team_equipas">'
                    .$manager->name.' 
                </p>
            </div>
            <div class="col-sm" id="btn_da_equipa">';
    /********************************************
    * Seguidores das equipas
    **********************************************/
    // equipa está no favoritos equipa da casa
    $stmt_fav_man = $fav_man->searchByUserByManagers($_SESSION['uid'], $manager->id);
    $num_fav_man = $stmt_fav_man->rowCount();
    if ($num_fav_man > 0) {
        // Apresentar conteudos da equipa da casa
        while ($row_fav_man = $stmt_fav_man->fetch(PDO::FETCH_ASSOC)) {
            if(($row_fav_man['iduser'] == $_SESSION['uid']) && ($row_fav_man['idmanager'] == $manager->id)){
                $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($manager->name_country).'&a=eliminar-treinador&nameman='.sanitizeString($row_fav_man['nickname_manager']).'&idman='.$row_fav_man['idmanager'].'&idfav_man='.$row_fav_man['id'].'" id="a_play">
                                <button id="btn_seguindo2">Seguindo
                                    <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                </button>
                            </a>';
            }
        }
    }else{
        if(isset($_SESSION['uid'])){
            $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($manager->name_country).'&a=adicionar-treinador&nameman='.sanitizeString($manager->nickname).'&idmanager='.$manager->id.'" id="a_play">
                                <button id="btn_seguir1">Seguir</button>
                            </a>';
        }else{
            $html .= '    
                            <button data-toggle="modal" data-target="#myModal1" id="btn_seguir1">Seguir</button>
                            <div class="modal fade" id="myModal1">
                                <div class="modal-dialog">
                                    <div class="modal-content" id="modal_prin">
                                        <!-- Modal Header -->
                                        <div class="modal-header" id="header_mod">
                                            <h4 class="modal-title">Para Adicionar Equipa</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body" id="body_mod">
                                            <p><img src="./logotipos/treinadores/'.$manager->photo_manager.'" id="logo_team_jogo"></p>
                                            <p><h5><strong id="team_mod">'.$manager->nickname_player.'</strong></h5></p>
                                            <p>É necessário ter a sessão iniciada</p>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        }
    }
    // favoritos a seguir a equipa da casa
    $stmt_fav_seg = $fav_man->searchSegMan($manager->id);
    // Obter reg de seguidores da equipa da casa
    while ($row_fav_seg = $stmt_fav_seg->fetch(PDO::FETCH_ASSOC)) {
        $html .= '
                            <p id="seg_jog">'.$row_fav_seg['seg'].'K
                                <span id="txt_seg_jog">seguidores</span>
                            </p>
                        </div>';
    }
    $html .='
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-sm">
                <!-- Nav pills -->
                <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#perfil" id="menu1">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#jogos" id="menu2">Jogos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#carreira" id="menu3">Carreira</a>
                </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="perfil" class="container tab-pane active"><br><br><br>';
    /*****************************************************************
    * Começa conteiner perfil
    * ***********************************************************************/
    $data_act = date('Y');
    $idade = $data_act-date('Y',strtotime($manager->birth_date));
    $html .='
                        <div class="row" id="row_play">
                            <div class="col-sm-3" id="col_info_play">
                                    <img src="./logotipos/clubes/'.$manager->logo_team_entry.'" id="img_log_play">
                                    '.$manager->nickname_team_entry.'
                                <p id="row_info_play">
                                    Contrato até   
                                    '.date('d-m-Y',strtotime($manager->contract_date)).'
                                </p>
                            </div>
                            <div class="col-sm-3" id="col_info_play">
                                    '.$idade.' anos                                        
                                <p id="row_info_play">
                                    Nascido '.date('d-m-Y',strtotime($manager->birth_date)).'   
                                </p>
                            </div>
                            <div class="col-sm-3" id="col_info_play">
                                    '.$manager->favorite_tatic.'                                        
                                <p id="row_info_play">
                                    Tática Favorita    
                                </p>
                            </div>
                        </div>
                        <br><br><br>';
                        
    /*****************************************************************
    * Começa estatisticas
    * ***********************************************************************/
    /*****************************************************************
    * Fim do conteiner perfil
    * ***********************************************************************/
    $html .='
                    </div><br><br><br>
                    <div id="jogos" class="container tab-pane fade"><br><br><br>';
    /*****************************************************************
    * começa conteiner jogos
    * ***********************************************************************/
    $html .='
                    </div>
                    <div id="carreira" class="container tab-pane fade"><br><br><br>';
    /*****************************************************************
    * começa conteiner jogos
    * ***********************************************************************/            
    $html .='
                    ';
    /*****************************************************************
    * fim conteiner jogos
    * ***********************************************************************/
    
            
    $html .='


                    </div>
                </div>
            </div>
        </div>';
    
}else{
    $html .='';
}
$html .='</div>';
echo $html;           