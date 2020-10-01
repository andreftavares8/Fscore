<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe

require_once './objects/Competitions.php';
require_once './objects/Favorites_Competitions.php';

session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';

// Criar objeto da Classe
$competi = new Competitions($pdo);
$fav_comp = new Favorites_Competitions($pdo);
// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$competi->id=$id;

// Obter Produtos e número de registos
$competi->readOne();
$html ='
    <div class="container"><br><br>';
if ($competi->name != null) {
    $html .= '
        <div class="row">
            <div class="col-sm-2" id="team_equipa_logo">
                <img src="./logotipos/competicoes/'.$competi->logo_competition.'" id="img_team_logo_equipa">
            </div>
            <div class="col-sm-4" id="team_equipa">
                <img src="./logotipos/paises/'.$competi->flag_country.'" id="img_pais_flag_equipa">'
                .$manager->name_country.'<br><br>
                <p id="txt_team_equipas">'
                    .$competi->name.' 
                </p>
            </div>
            <div class="col-sm" id="btn_da_equipa">';
    /********************************************
    * Seguidores das competicoes
    **********************************************/
    // equipa está no favoritos equipa da casa
    $stmt_fav_comp = $fav_comp->searchByUserByCompetitions($_SESSION['uid'], $competi->id);
    $num_fav_comp = $stmt_fav_comp->rowCount();
    if ($num_fav_comp > 0) {
        // Apresentar conteudos da equipa da casa
        while ($row_fav_comp = $stmt_fav_comp->fetch(PDO::FETCH_ASSOC)) {
            if(($row_fav_comp['iduser'] == $_SESSION['uid']) && ($row_fav_comp['idcompetition'] == $competi->id)){
                $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($competi->name_country).'&namefed='.sanitizeString($row_fav_comp['competition_type']).'&a=eliminar-competicao&namecomp='.sanitizeString($competi->name).'&idcomp='.$row_fav_comp['idcompetition'].'&idfav_comp='.$row_fav_comp['id'].'" id="a_play">
                                <button id="btn_seguindo2">Seguindo
                                    <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                </button>
                            </a>';
            }
        }
    }else{
        if(isset($_SESSION['uid'])){
            $html .= '
                            <a href="?m=favoritos&namep='.sanitizeString($competi->name_country).'&namefed='.sanitizeString($competi->competition_type).'&a=adicionar-competicao&namecomp='.sanitizeString($competi->name).'&idcomp='.$competi->id.'" id="a_play">
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
                                            <p><img src="./logotipos/competicoes/'.$competi->logo_competition.'" id="logo_team_jogo"></p>
                                            <p><h5><strong id="team_mod">'.$competi->name.'</strong></h5></p>
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
    $stmt_fav_seg = $fav_comp->searchSegComp($competi->id);
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
                    <a class="nav-link active" data-toggle="pill" href="#perfil" id="menu1">Vista Geral</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#jogos" id="menu2">Jogos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#estatisticas" id="menu3">Estatisticas</a>
                </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="perfil" class="container tab-pane active"><br><br><br>';
    /*****************************************************************
    * Começa conteiner vista geral
    * ***********************************************************************/
   
    $html .='
                        </div>
                        <br><br><br>';
                        
    /*****************************************************************
    * Começa clasficação
    * ***********************************************************************/
    /*****************************************************************
    * Fim do conteiner vista geral
    * ***********************************************************************/
    $html .='
                    </div><br><br><br>
                    <div id="jogos" class="container tab-pane fade"><br><br><br>';
    /*****************************************************************
    * começa conteiner jogos
    * ***********************************************************************/
    $html .='
                    </div>
                    <div id="estatisticas" class="container tab-pane fade"><br><br><br>';
    /*****************************************************************
    * começa conteiner estatisticas
    * ***********************************************************************/            
    $html .='
                    ';
    /*****************************************************************
    * fim conteiner estatisticas
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