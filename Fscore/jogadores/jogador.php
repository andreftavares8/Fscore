<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe

require_once './objects/Players.php';
require_once './objects/Favorites_Players.php';
require_once './objects/Players_Transfers.php';

session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';

// Criar objeto da Classe
$player = new Players($pdo);
$fav_play= new Favorites_Players($pdo);
$play_transf = new Players_Transfers($pdo);
// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$player->id=$id;

// Obter Produtos e número de registos
$player->readOne();
$html ='
    <div class="container"><br><br>';
if ($player->name != null) {
    $html .= '
        <div class="row">
            <div class="col-sm-2" id="team_equipa_logo">
                <img src="./logotipos/jogadores/'.$player->photo_player.'" id="logo_team_jogo">
            </div>
            <div class="col-sm-4" id="team_equipa">
                <img src="./logotipos/paises/'.$player->flag_country.'" id="img_pais_flag_equipa">'
                .$player->name_country.'<br><br>
                <p id="txt_team_equipas">'
                    .$player->name.' 
                </p>
            </div>
            <div class="col-sm" id="btn_da_equipa">';
    /********************************************
    * Seguidores das equipas
    **********************************************/
    // equipa está no favoritos equipa da casa
    $stmt_fav_play = $fav_play->searchByUserByPayers($_SESSION['uid'], $player->id);
    $num_fav_play = $stmt_fav_play->rowCount();
    if ($num_fav_play > 0) {
        // Apresentar conteudos da equipa da casa
        while ($row_fav_play = $stmt_fav_play->fetch(PDO::FETCH_ASSOC)) {
            if(($row_fav_play['iduser'] == $_SESSION['uid']) && ($row_fav_play['idplayer'] == $player->id)){
                $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($player->name_country).'&a=eliminar-jogador&nameplay='.sanitizeString($row_fav_play['nickname_player']).'&idplay='.$row_fav_play['idplayer'].'&idfav_play='.$row_fav_play['id'].'" id="a_play">
                                <button id="btn_seguindo2">Seguindo
                                    <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                </button>
                            </a>';
            }
        }
    }else{
        if(isset($_SESSION['uid'])){
            $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($player->name_country).'&a=adicionar-jogador&nameplay='.sanitizeString($player->nickname).'&idplayer='.$player->id.'" id="a_play">
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
                                            <p><img src="./logotipos/jogadores/'.$player->photo_player.'" id="logo_team_jogo"></p>
                                            <p><h5><strong id="team_mod">'.$player->nickname_player.'</strong></h5></p>
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
    $stmt_fav_seg = $fav_play->searchSegPlay($player->id);
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
    $idade = $data_act-date('Y',strtotime($player->birth_date));
    $html .='
                        <div class="row" id="row_play">
                            <div class="col-sm-3" id="col_info_play">
                                    <img src="./logotipos/clubes/'.$player->logo_team_entry.'" id="img_log_play">
                                    '.$player->nickname_team_entry.'
                                <p id="row_info_play">
                                    Contrato até   
                                    '.date('d-m-Y',strtotime($player->contract_date)).'
                                </p>
                            </div>
                            <div class="col-sm-3" id="col_info_play">
                                    '.$player->number_shirt.'                                        
                                <p id="row_info_play">
                                    Número    
                                </p>
                            </div>
                            <div class="col-sm-3" id="col_info_play">
                                    '.$idade.' anos                                        
                                <p id="row_info_play">
                                    Nascido '.date('d-m-Y',strtotime($player->birth_date)).'   
                                </p>
                            </div>
                            <div class="col-sm-3" id="col_info_play">
                                    '.$player->position.'                                        
                                <p id="row_info_play">
                                    Posição    
                                </p>
                            </div>
                        </div>
                        <div class="row" id="row_play">
                            <div class="col-sm" id="col_info_play">
                                    '.$player->weight.'                                        
                                <p id="row_info_play">
                                    Peso    
                                </p>
                            </div>
                            <div class="col-sm" id="col_info_play">
                                    '.$player->height.'                                        
                                <p id="row_info_play">
                                    Altura    
                                </p>
                            </div>
                            <div class="col-sm" id="col_info_play">
                                    '.$player->favorite_foot.'                                        
                                <p id="row_info_play">
                                    Pé Favorito    
                                </p>
                            </div>
                            <div class="col-sm" id="col_info_play">
                                    '.$player->valor_actual.'                                        
                                <p id="row_info_play">
                                    Valor Jogador    
                                </p>
                            </div>
                        </div><br><br><br>
                        <div class="row">
                            <div class="col-sm-2" id="player_equipa_joga">Estatisticas</div>
                            <div class="col-sm-5" id="player_equipa_jog"></div>
                            <div class="col-sm-5" id="icons_play">
                                <div class="row">
                                    <div class="col-sm" id="icon1">
                                        <img src="./logotipos/icons/play1.png" id="img_play">
                                    </div>
                                    <div class="col-sm" id="icon1">
                                        <img src="./logotipos/icons/bola1.png" id="img_play">
                                    </div>
                                    <div class="col-sm" id="icon2">
                                        <img src="./logotipos/icons/assis.png" id="img_play">
                                    </div>
                                    <div class="col-sm" id="icon3">
                                        <img src="./logotipos/icons/yellow_card.png" id="img_play">
                                    </div>
                                    <div class="col-sm" id="icon4">
                                        <img src="./logotipos/icons/red_card.png" id="img_play">
                                    </div>
                                </div>
                            </div>
                        </div>';
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