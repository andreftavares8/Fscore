<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

//Carregar Classe
require_once './objects/Teams.php';
require_once './objects/Favorites_Teams.php';
require_once './objects/Players.php';
require_once './objects/Managers.php';
require_once './objects/Stadiums.php';
require_once './objects/Games_clashes.php';
require_once './objects/Teams_Competitions.php';
require_once './objects/Matchs_Results.php';

session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}
// caregar as duas funcoes
require_once './common/funcoes/funcoes.php';

// Criar objeto da Classe
$team = new Teams($pdo);
$fav_team= new Favorites_Teams($pdo);
$play= new Players($pdo);
$man= new Managers($pdo);
$sta= new Stadiums($pdo);
$game= new Games_Clashes($pdo);
$team_comp= new Teams_Competitions($pdo);
$team_mat_result= new Matchs_Results($pdo);
// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$team->id=$id;

// Obter Produtos e número de registos
$team->readOne();
$html ='
    <div class="container"><br><br>';
if ($team->name != null) {
    if(($team->nickname === $team->name_country) || ($team->name === 'no team')){$html .= '';}else{
        $html .= '
        <div class="row">
            <div class="col-sm-2" id="team_equipa_logo">
                <img src="./logotipos/clubes/'.$team->logo_team.'" id="img_team_logo_equipa">
            </div>
            <div class="col-sm-4" id="team_equipa">
                <img src="./logotipos/paises/'.$team->flag_country.'" id="img_pais_flag_equipa">'
                .$team->name_country.'<br><br>
                <p id="txt_team_equipas">'
                    .$team->name.' 
                </p>
            </div>
            <div class="col-sm" id="btn_da_equipa">';
        /********************************************
        * Seguidores das equipas
        **********************************************/
        // equipa está no favoritos equipa da casa
        $stmt_fav_team = $fav_team->searchByUserByTeams($_SESSION['uid'], $team->id);
        $num_fav_team = $stmt_fav_team->rowCount();
        if ($num_fav_team > 0) {
            // Apresentar conteudos da equipa da casa
            while ($row_fav_team = $stmt_fav_team->fetch(PDO::FETCH_ASSOC)) {
                if(($row_fav_team['iduser'] == $_SESSION['uid']) && ($row_fav_team['idteam'] == $team->id)){
                    $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($team->name_country).'&a=eliminar-equipa&nameteam='.sanitizeString($team->nickname).'&idteam='.$row_fav_team['idteam'].'&idfav_equi='.$row_fav_team['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>';
                }
            }
        }else{
            if(isset($_SESSION['uid'])){
                $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($team->name_country).'&a=adicionar-equipa&nameteam='.sanitizeString($team->nickname).'&idteam='.$team->id.'" id="a_play">
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
                                                <p><img src="./logotipos/clubes/'.$team->logo_team.'" id="logo_team_jogo"></p>
                                                <p><h5><strong id="team_mod">'.$team->nickname.'</strong></h5></p>
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
        $stmt_fav_seg = $fav_team->searchSegTeam($team->id);
        // Obter reg de seguidores da equipa da casa
        while ($row_fav_seg = $stmt_fav_seg->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                                <p id="seg_jog">'.$row_fav_seg['seg'].'K
                                    <span id="txt_seg_jog">seguidores</span>
                                </p>
                            </div>';
        }
        $html .='
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5" id="btn_but">';
    
            

        $html .='
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-sm">
            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                <a  class="nav-link active" data-toggle="pill" href="#vista_geral" id="menu1">Vista Geral</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#jogos" id="menu2">Jogos</a>
                </li>
                <li class="nav-item">
                <a  class="nav-link" data-toggle="pill" href="#trofeus" id="menu3">Troféus</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="vista_geral"class="container tab-pane active" ><br><br><br>
                    <div class="row">
                        <div class="col-sm" id="logo_kit_equipa_home">
                            <img src="./logotipos/clubes/'.$team->logo_kit_home.'" id="logo_team_jogo">
                            <p>Equipamento Principal</p>
                        </div>
                        <div class="col-sm" id="logo_kit_equipa_away">
                            <img src="./logotipos/clubes/'.$team->logo_kit_away.'" id="logo_team_jogo">
                            <p>Equipamento Alternativo</p>
                        </div>
                    </div><br><br>';

    
    /***************************************************************************************
            * Clasificação 
    *******************************************************************************************/
        $pontos_vit = 3;
        $pontos_derr = 0;
        $pontos_emp = 1;
        $num_vit = 1;
        $num_derr = 1;
        $num_emp = 1; 
        $html .='
                    <div class="row">
                    <div class="col-sm">';
        $stmt_team_mat_result = $team_mat_result->read(); 
        while ($row_team_mat_result = $stmt_team_mat_result->fetch(PDO::FETCH_ASSOC)) {
            if((date('Y',strtotime($row_team_mat_result['date_game'])) == date('Y')-1)||(date('Y',strtotime($row_team_mat_result['date_game']))== date('Y'))){
                
                if($row_team_mat_result['scores_home'] < $row_team_mat_result['scores_away']){
                    $ph = 0;
                    $pa = 3;
               
                }else{
                    $ph = 3;
                    $pa = 0;
                  
                } 
                if($row_team_mat_result['scores_home'] == $row_team_mat_result['scores_away']){
                    $ph = 1;
                    $pa = 1;
                   
                }

                if($row_team_mat_result['idteam_home'] == $row_team_mat_result['idteam_away']){
                    $p = $ph + $pa;
                    $t = $row_team_mat_result['idteam_home']= $row_team_mat_result['idteam_away'];
                
                    $html .='<div class="col-sm">
             '.$t.'
            
             </div><div class="row">
              '.$p.'
             
             </div>';
                }
            }
        }
        $html .='</div></div>';
        $html .='
                    <div class="row">
                        <div class="col-sm-5" id="player_equipa_jog"></div>
                        <div class="col-sm" id="player_equipa_joga">Clasificação</div>
                        <div class="col-sm-5" id="player_equipa_jog"></div><br><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Equipa</th>
                                    <th scope="col">P</th>
                                    <th scope="col"> V</th>
                                    <th scope="col"> E</th>
                                    <th scope="col"> D</th>
                                    <th scope="col"> Gls</th>
                                    <th scope="col">DGls</th>
                                    <th scope="col">Pts</th>
                                    <th scope="col">Últimas Partidas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td colspan="2"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br><br>
                    <div class="row">
                            <div class="col-sm-5" id="player_equipa_jog"></div>
                            <div class="col-sm" id="player_equipa_joga">Jogadores</div>
                            <div class="col-sm-5" id="player_equipa_jog"></div>
                    </div><br><br>
                    <div class="row" id="lin_players_equipa">';
        /******************************************************************************************************
        * Jogadores plantel
        ******************************************************************************************************/
        $stmt_play = $play->read(); 
        while ($row_play = $stmt_play->fetch(PDO::FETCH_ASSOC)) {
            if(($row_play['idteam_entry'] == $team->id) && ($row_play['contract_date'] > date('Y-m-d'))){
                if($row_play['position'] === 'Avançado'){
                    $html .= '                                            
                        <div class="col-sm-2" id="player_equipa">
                            <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"  id="a_jog">
                                <img src="./logotipos/jogadores/'.$row_play['photo_player'].'" id="photo_player_equipa">
                            </a>
                            <div id="numero_efect">
                                <span id="number_shirt_equipa">'.$row_play['number_shirt'].'</span>
                            </div>
                            <div class="row" id="txt_player_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'" id="a_jog">
                                    <span id="txt_player_equipa">'.$row_play['nickname'].'</span>
                                </a>
                            </div>
                            <div class="row" id="pos_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <span id="avan_equip">'.$row_play['position'].'</span>
                                </a>
                            </div>
                            <div class="row" id="flag_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <img src="./logotipos/paises/'.$row_play['flag_country'].'" id="img_pais_flag_equipa">
                                    <span id="flag_play_equipa">'.$row_play['name_country'].'</span>
                                </a>
                            </div> 
                        </div>';
                }
                if($row_play['position'] === 'Médio'){
                    $html .= '
                        <div class="col-sm-2" id="player_equipa">
                            <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"  id="a_jog">
                                <img src="./logotipos/jogadores/'.$row_play['photo_player'].'" id="photo_player_equipa">
                            </a>
                            <div id="numero_efect">
                                <span id="number_shirt_equipa">'.$row_play['number_shirt'].'</span>
                            </div>
                            <div class="row" id="txt_player_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'" id="a_jog">
                                    <span id="txt_player_equipa">'.$row_play['nickname'].'</span>
                                </a>
                            </div>
                            <div class="row" id="pos_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <span id="med_equip">'.$row_play['position'].'</span>
                                </a>
                            </div>
                            <div class="row" id="flag_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <img src="./logotipos/paises/'.$row_play['flag_country'].'" id="img_pais_flag_equipa">
                                    <span id="flag_play_equipa">'.$row_play['name_country'].'</span>
                                </a>
                            </div> 
                        </div>';
                }
                if($row_play['position'] === 'Defesa'){
                    $html .= '
                        <div class="col-sm-2" id="player_equipa">
                            <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"  id="a_jog">
                                <img src="./logotipos/jogadores/'.$row_play['photo_player'].'" id="photo_player_equipa">
                            </a>
                            <div id="numero_efect">
                                <span id="number_shirt_equipa">'.$row_play['number_shirt'].'</span>
                            </div>
                            <div class="row" id="txt_player_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'" id="a_jog">
                                    <span id="txt_player_equipa">'.$row_play['nickname'].'</span>
                                </a>
                            </div>
                            <div class="row" id="pos_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <span id="def_equip">'.$row_play['position'].'</span>
                                </a>
                            </div>
                            <div class="row" id="flag_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <img src="./logotipos/paises/'.$row_play['flag_country'].'" id="img_pais_flag_equipa">
                                    <span id="flag_play_equipa">'.$row_play['name_country'].'</span>
                                </a>
                            </div> 
                        </div>';
                }
                if($row_play['position'] === 'Guarda-Redes'){
                    $html .= '
                        <div class="col-sm-2" id="player_equipa">
                            <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"  id="a_jog">
                                <img src="./logotipos/jogadores/'.$row_play['photo_player'].'" id="photo_player_equipa">
                            </a>
                            <div id="numero_efect">
                                <span id="number_shirt_equipa">'.$row_play['number_shirt'].'</span>
                            </div>
                            <div class="row" id="txt_player_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'" id="a_jog">
                                    <span id="txt_player_equipa">'.$row_play['nickname'].'</span>
                                </a>
                            </div>
                            <div class="row" id="pos_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <span id="red_equip">'.$row_play['position'].'</span>
                                </a>
                            </div>
                            <div class="row" id="flag_play_equipa">
                                <a href="?m=jogadores&'.sanitizeString($row_play['name_country']).'&a=jogador&'.sanitizeString($row_play['nickname_player']).'&id='.$row_play['id'].'"id="a_jog">
                                    <img src="./logotipos/paises/'.$row_play['flag_country'].'" id="img_pais_flag_equipa">
                                    <span id="flag_play_equipa">'.$row_play['name_country'].'</span>
                                </a>
                            </div> 
                        </div>';
                }
            }
        }
        $html .='
                    </div><br><br>
                    <div class="row">
                        <div class="col-sm-5" id="player_equipa_jog"></div>
                        <div class="col-sm" id="player_equipa_joga">Treinador</div>
                        <div class="col-sm-5" id="player_equipa_jog"></div>
                    </div><br><br>
                    <div class="row">';
        /*****************************************************************************************************************
        * Treinador do clube
        ********************************************************************************************************/
        $stmt_man = $man->read(); 
        while ($row_man = $stmt_man->fetch(PDO::FETCH_ASSOC)) {
            if(($row_man['idteam_entry'] == $team->id) && ($row_man['contract_date'] > date('Y-m-d'))){
                $html .= '
                        <div class="col-sm" id="manager_equipa">
                            <div class="col-sm-2">
                                <a href="?m=treinadores&'.sanitizeString($row_man['name_country']).'&a=treinador&'.sanitizeString($row_man['nickname_manager']).'&id='.$row_man['id'].'"id="a_jog">
                                    <img src="./logotipos/treinadores/'.$row_man['photo_manager'].'" id="photo_player_equipa">
                                </a>
                                <div class="row" id="txt_player_equipa">
                                    <a href="?m=treinadores&'.sanitizeString($row_man['name_country']).'&a=treinador&'.sanitizeString($row_man['nickname_manager']).'&id='.$row_man['id'].'"id="a_jog">
                                        <span id="txt_player_equipa">'.$row_man['nickname'].'</span>
                                    </a>
                                </div>
                                <div class="row" id="flag_play_equipa">
                                    <div class="col-sm">
                                        <a href="?m=treinadores&'.sanitizeString($row_man['name_country']).'&a=treinador&'.sanitizeString($row_man['nickname_manager']).'&id='.$row_man['id'].'"id="a_jog">
                                            <img src="./logotipos/paises/'.$row_man['flag_country'].'" id="img_pais_flag_equipa">
                                            <span id="flag_play_equipa">'.$row_man['name_country'].'</span>
                                        </a>
                                    </div>
                                </div> 
                            </div> 
                        </div>';
            }
        }     
        $html .='       
                    </div><br><br>';
        /**********************************************************************************************************
        * informaçao do clube
        * ********************************************************************************************************************************* */       
        $html .='
                    <div class="row">
                        <div class="col-sm-5" id="info_row_club_equi">
                            <div class="row" id="sem_cor">
                                <div class="col-sm" id="equip_info"></div>
                                <div class="col-sm" id="player_equipa_joga">Clube</div>
                                <div class="col-sm" id="equip_info"></div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="name_comp">
                                    '.$team->name.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="abv_team">
                                    '.$team->nickname.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Presidente
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.$team->president.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Fundação
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.date('d-m-Y',strtotime($team->foundation)).'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Cidade 
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.$team->city.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                    <div class="col-sm" id="t_info">
                                        E-mail
                                    </div>
                                    <div class="col-sm" id="txt_info">
                                        <a href="mailto:'.$team->email.'" id="txt_web">
                                            '.$team->email.'
                                        </a>
                                    </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Website
                                </div> 
                                <div class="col-sm" id="txt_info">
                                    <a href="mailto:'.$team->website.'" target="_blank" id="txt_web">
                                        '.$team->website.'
                                    </a>
                                </div>
                            </div> 
                            <div class="row" id="sem_cor"></div>
                        </div>
                        <div class="col-sm-2"></div>';
        /*******************************************************************************
        *  Estadio do clube
        *****************************************************************************************/
        $id = $team->idstadium;
        $id = filter_var($id);
        $sta->id=$id;
        $sta->readOne();
        $html .='
                        <div class="col-sm-5"  id="info_row_club_sta">
                            <div class="row" id="sem_cor">
                                <div class="col-sm" id="equip_info"></div>
                                <div class="col-sm" id="player_equipa_joga">Estádio</div>
                                <div class="col-sm" id="equip_info"></div>
                            </div>
                            <div class="row" id="info_sta">
                                <div class="col-sm" id="abv_team">
                                    '.$sta->name.'
                                </div>
                                <div class="col-sm" id="info_clu_sta">
                                    <img src="./logotipos/clubes/'.$sta->logo_stadium.'" id="img_stad_equi">
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Capacidade
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.$sta->capacity.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Cidade
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.$sta->city.'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Fundação
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.date('d-m-Y',strtotime($sta->foundation)).'
                                </div>
                            </div>
                            <div class="row" id="info_club">
                                <div class="col-sm" id="t_info">
                                    Estado do Campo 
                                </div>
                                <div class="col-sm" id="txt_info">
                                    '.$sta->grass_type.'
                                </div>
                            </div>
                            <div class="row" id="sem_cor"></div>
                        </div><br><br>';
                        
                            
        $html .='      
                    </div>
                    <div class="row" id="row_fund"></div>
                </div>';
        /*****************************************************************************************************************
        * termina conteiner vista geral
        ********************************************************************************************************/
        /*****************************************************************************************************************
        *começa conteiner jogos
        ********************************************************************************************************/                
        $html .='
                <div id="jogos" class="container tab-pane fade"><br><br>
                    <div class="row">
                        <div class="col-sm">';
                
        $stmt_game = $game->search($team->id); 
        while ($row_game = $stmt_game->fetch(PDO::FETCH_ASSOC)) {
            if(($row_game['date_game'] >=$row_game['start_date']) && ($row_game['date_game']<=$row_game['end_date'])){
                $html .= '
                        <div class="row" id="col_comp_equi">
                            <div class="col-sm-4" id="logo_comp_equip">
                                <img src="./logotipos/competicoes/'.$row_game['logo_competition'].'" id="img_comp_equi">
                            </div>
                            <div class="col-sm-4" id="txt_comp_equip">'.$row_game['name_competition'].'</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" id="log_h_equi">
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="log_a_aqui">
                                    '.$row_game['home_nickname'].'
                                    <img src="./logotipos/clubes/'.$row_game['home_logo_team'].'" id="img_log_equi">
                                </a>
                            </div>
                        <div class="col-sm-2" id="da_vert">';
                if(($row_game['scores_home'] === null ) && ($row_game['scores_away'] === null)){ 
                    $html .= '                           
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">
                                    <span id="date_equip">
                                        '.date('d-m-Y',strtotime($row_game['date_game'])).
                                    '</span>
                                </a>';
                }else{
                    if($team->id === $row_game['idteam_home']){
                        if($row_game['scores_home']> $row_game['scores_away']){
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">

                                    <span id="jog_gan">
                                        '.$row_game['scores_home'].
                                    '</span> 
                                    <span id="jog_tra">-</span>
                                    <span id="jog_gan">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>';
                            $jog = '<div id="efect_jog_vitoria"><span id="jog_vitoria">V<span></div>';
                        }
                        elseif($row_game['scores_home']< $row_game['scores_away']){
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">

                                    <span id="jog_perd">
                                    '.$row_game['scores_home'].
                                    '</span> 
                                    <span id="jog_tra">-</span>
                                    <span id="jog_perd">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>';
                            $jog = '<div id="efect_jog_perdido"><span id="jog_perdido">P<span></div>';
                        }
                        else{
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">
                                    <span id="jog_emp">
                                        '.$row_game['scores_home'].
                                    '</span> 
                                    <span id="jog_tra">-</span>
                                    <span id="jog_emp">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>'; 
                            $jog = '<div id="efect_jog_empate"><span id="jog_empate">E<span></div>';   
                        }
                    }
                    if($team->id === $row_game['idteam_away']){
                        if($row_game['scores_away']> $row_game['scores_home']){
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">
                                    <span id="jog_gan">
                                        '.$row_game['scores_home'].
                                    '</span> 
                                    <span id="jog_tra">-</span>
                                    <span id="jog_gan"">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>';
                            $jog = '<div id="efect_jog_vitoria"><span id="jog_vitoria">V<span></div>';  
                        }
                        elseif($row_game['scores_away']< $row_game['scores_home']){
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">
                                    <span id="jog_perd">
                                        '.$row_game['scores_home'].
                                    '</span> 
                                    <span id="jog_tra">-</span>
                                    <span id="jog_perd">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>';
                            $jog = '<div id="efect_jog_perdido"><span id="jog_perdido">P<span></div>'; 
                        }else{
                            $html .= '
                                <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="a_play">
                                    <span id="jog_emp">
                                        '.$row_game['scores_home'].
                                    '</span>
                                    <span id="jog_tra">-</span>
                                    <span id="jog_emp">
                                        '.$row_game['scores_away'].
                                    '</span>
                                </a>';
                            $jog = '<div id="efect_jog_empate"><span id="jog_empate">E<span></div>';     
                        }

                    }
                }
                $html .= '
                        </div>
                        <div class="col-sm-4" id="log_a_aqui">
                            <a href="?m=encontros&'.sanitizeString($row_game['name_country']).'&a=jogo&'.sanitizeString($row_game['home_nickname']).'-'.sanitizeString($row_game['away_nickname']).'&id='.$row_game['id'].'" id="log_a_aqui">
                                <img src="./logotipos/clubes/'.$row_game['away_logo_team'].'" id="img_log_equi">'
                                .$row_game['away_nickname'].'
                            </a>
                        </div>
                        <div class="col-sm" id="cor_jogo">';
                            $html .=$jog;
                $html .= '
                        </div>
                    </div>';
            }
        }  
        $html .='      
                </div>
            </div>
            <div class="row" id="row_fund"></div>
        </div>';
        /*************************************************************************************************************************
         * Termina os jogos
         *******************************************************************************************************************************/ 
        /*************************************************************************************************************************
         * Começa os trofeus
         *******************************************************************************************************************************/ 
        $html .=' 
            <div id="trofeus"  class="container tab-pane fade"><br><br><br>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-10"  id="info_row">
                        <div class="row" id="sem_cor">
                            <div class="col-sm" id="equip_info"></div>
                            <div class="col-sm" id="player_equipa_joga">Carreira do Clube</div>
                            <div class="col-sm" id="equip_info"></div>
                        </div>
                    ';
                        
        $stmt_team_comp = $team_comp->search($team->id); 
        while ($row_team_comp = $stmt_team_comp->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                        <div class="row" id="tit_equi">
                            <div class="col-sm" id="temp">
                                Temporada 
                            </div>
                            <div class="col-sm" id="tit">
                                Títulos    
                            </div>
                        </div>
                        <div class="row" id="row_tit_comp">
                            <div class="col-sm" id="temp_comp_trof">
                                '.date('Y',strtotime($row_team_comp['start_date'])).
                                '/'.date('Y',strtotime($row_team_comp['end_date'])).'
                            </div>
                            <div class="col-sm" id="img_log_comp_trof">
                                <img src="./logotipos/competicoes/'.$row_team_comp['logo_competition'].'" id="img_comp_trof">

                            </div>
                            <div class="col-sm" id="name_comp_trf">
                                    '.$row_team_comp['name_competition'].'
                            </div>
                            <div class="col-sm" id="tip_tit">
                                    '.$row_team_comp['league_title'].'
                            </div>
                            <div class="col-sm" id="tip_tit">';

            if($row_team_comp['league_title'] ==='vencedor'){

                $html .= '
                                <img src="./logotipos/competicoes/'.$row_team_comp['logo_trophie'].'" id="img_comp_trof">
                            </div>

                            </div></div>';
            }
        }
        $html .= '
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="row_fund"></div>';
    }
}else{
    $html .='';
}
$html .='</div>';
echo $html;           
