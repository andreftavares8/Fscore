<?php
//Carregar Classe
require_once './objects/Games_Clashes.php';
require_once './objects/Favorites_Teams.php';
require_once './objects/Players_Matchs_Results.php';
require_once './objects/Players_Games_Clashes.php';
require_once './objects/Managers_Games_Clashes.php';
require_once './objects/Players_Statistics.php';
require_once './objects/Teams_Statistics.php';
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//error_reporting( E_WARNING );
//carregar funcao
require_once './common/funcoes/funcoes.php';

//sessao iniciada
session_start();

if(!isset($_SESSION['uid'])){
    session_destroy();
}

// Criar objeto da Classe
$game = new Games_Clashes($pdo);
$fav_seg = new Favorites_Teams($pdo);
$fav_team = new Favorites_Teams($pdo);
$game_mat_play = new Players_Matchs_Results($pdo);
$play_game_clashe = new Players_Games_Clashes($pdo);
$man_game_clashe = new Managers_Games_Clashes($pdo);
$play_stat = new Players_Statistics($pdo);
$team_stat = new Teams_Statistics($pdo);

// Obter ID e detalhes do produto
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$game->id=$id;
$html ='
    <div class="container"><br><br><br>';
// Obter Produtos e número de registos
$game->readOne();

if ($game->name_competition != null) {
    // Apresentar conteúdos
        /*********************************************************************************
         * Equipas no jogo sem golos
         **********************************************************************************/
    if (($game->scores_home == null) && ($game->scores_away == null)){ 
        $html .='
                <div class="row">
                    <div class="col-sm" id="competicao_pais_jogo">
                        <p>
                            <a href="?m=competicoes&'.sanitizeString($game->name_country).'&'.sanitizeString($game->competition_type).'&a=torneio&'.sanitizeString($game->name_competition).'&id='.$game->idcompetition.'" id="competicao_pais_jogo">
                                <img src="./logotipos/competicoes/'.$game->logo_competition.'" id="img_comp_jogo">'
                                .$game->name_competition.'
                            </a>
                        </p>
                        <p>
                                <img src="./logotipos/paises/'.$game->flag_country.'" id="img_pais_jogo">'
                                .$game->name_country.'
                        </p>
                    </div>
                </div>
                <div class="row">';
        /***********************************************************
         * mostrar a data e defenir equipas de equipa internacional
        ************************************************************/
        if($game->date_game > date('Y-m-d')){
            // defenir id do pais com o da equipa mesmo nome
            if($game->home_nickname == $game->name_country && $game->away_nickname == $game->name_country ){
                $html .='
                    <div class="col-sm-5" id="team_home_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                            <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->home_nickname.'</p>
                        </a>
                    </div>
                    <div class="col-sm-2" id="time_jogo">
                        Dia<br>
                        <p>'.date('d-m-Y',strtotime($game->date_game)).'</p>
                    </div>
                    <div class="col-sm-5" id="team_away_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                            <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->away_nickname.'</p>
                        </a>
                    </div>';
            //// id da equipa correto
            }else{
                $html .='       
                    <div class="col-sm-5" id="team_home_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                            <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->home_nickname.'</p>
                        </a>
                    </div>
                    <div class="col-sm-2" id="time_jogo">
                        Dia<br>
                        <p>'.date('d-m-Y',strtotime($game->date_game)).'</p>
                    </div>
                    <div class="col-sm-5" id="team_away_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                            <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->away_nickname.'</p>
                        </a>
                    </div>';  
            } 
        }
        // defenir id do pais com o da equipa mesmo nome
        if($game->home_nickname == $game->name_country && $game->away_nickname == $game->name_country ){
        $html .='
                    <div class="col-sm-5" id="team_home_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                            <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->home_nickname.'</p>
                        </a>
                    </div>
                    <div class="col-sm-2" id="time_jogo">
                        Hora<br>
                        <p>'.date('H:i',strtotime($game->time_game)).'</p>
                    </div>
                    <div class="col-sm-5" id="team_away_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                            <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->away_nickname.'</p>
                        </a>
                    </div>';
        //// id da equipa correto
        }else{
            $html .='       
                    <div class="col-sm-5" id="team_home_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                            <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->home_nickname.'</p>
                        </a>
                    </div>
                    <div class="col-sm-2" id="time_jogo">
                    Hora<br>
                        <p>'.date('H:i',strtotime($game->time_game)).'</p>
                    </div>
                    <div class="col-sm-5" id="team_away_jogo">
                        <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                            <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                            <p>'.$game->away_nickname.'</p>
                        </a>
                    </div>';  
        }
        $html .=' 
                </div>
                <div class="row">
                    <div class="col-sm-5" id="btn_but">';

        /********************************************
        * Seguidores das equipas
        **********************************************/
        // equipa está no favoritos equipa da casa
        $stmt_fav_team_home = $fav_team->searchByUserByTeams($_SESSION['uid'], $game->idteam_home);
        $num_fav_team_home = $stmt_fav_team_home->rowCount();
        if ($num_fav_team_home > 0) {
            // Apresentar conteudos da equipa da casa
            while ($row_fav_team_home = $stmt_fav_team_home->fetch(PDO::FETCH_ASSOC)) {
                if(($row_fav_team_home['iduser'] == $_SESSION['uid']) && ($row_fav_team_home['idteam'] == $game->idteam_home)){
                    $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=eliminar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idfav='.$row_fav_team_home['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>';
                }
            }
        }else{
            if(isset($_SESSION['uid'])){
                $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=adicionar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idteam_jogo='.$game->idteam_home.'" id="a_play">
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
                                                <p><img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo"></p>
                                                <p><h5><strong id="team_mod">'.$game->home_nickname.'</strong></h5></p>
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
        $stmt_fav_seg_home = $fav_seg->searchSegTeam($game->idteam_home);
        // Obter reg de seguidores da equipa da casa
        while ($row_fav_seg_home = $stmt_fav_seg_home->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                                <p id="seg_jog">'.$row_fav_seg_home['seg'].'K
                                    <span id="txt_seg_jog">seguidores</span>
                                </p>
                            </div>';
        }
        $html .='
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5" id="btn_but">';

        // equipa está no favoritos equipa de fora
        $stmt_fav_team_away = $fav_team->searchByUserByTeams($_SESSION['uid'], $game->idteam_away);
        $num_fav_team_away = $stmt_fav_team_away->rowCount();
        if ($num_fav_team_away > 0) {
            // Apresentar conteudos da equipa da fora
            while ($row_fav_team_away = $stmt_fav_team_away->fetch(PDO::FETCH_ASSOC)) {
            
                if(($row_fav_team_away['iduser'] == $_SESSION['uid']) && ($row_fav_team_away['idteam'] == $game->idteam_away)){
                     $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=eliminar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idfav='.$row_fav_team_away['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>';
                }
            }
        }else{

            if(isset($_SESSION['uid'])){
                $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=adicionar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idteam_jogo='.$game->idteam_away.'" id="a_play">
                                    <button id="btn_seguir1">Seguir</button>
                                </a>';
            }else{
                $html .= '    
                                <button data-toggle="modal" data-target="#myModal2" id="btn_seguir1">Seguir</button>
                                <div class="modal fade" id="myModal2">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="modal_prin">
                                            <!-- Modal Header -->
                                            <div class="modal-header" id="header_mod">
                                                <h4 class="modal-title">Para Adicionar Equipa</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body" id="body_mod">
                                                <p><img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo"></p>
                                                <p><h5><strong id="team_mod">'.$game->away_nickname.'</strong></h5></p>
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
        // Obter reg de seguidoresvequipa da fora
        $stmt_fav_seg_away = $fav_seg->searchSegTeam($game->idteam_away);
        // Apresentar conteudos dos paises
        while ($row_fav_seg_away = $stmt_fav_seg_away->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                                <p id="seg_jog">'.$row_fav_seg_away['seg'].'K
                                    <span id="txt_seg_jog">seguidores</span>
                                </p>
                            </div>';
        }
        $html .= '
                </div><br><br>
                <div class="row">
                    <div class="col-sm">
                        <!-- Nav pills -->
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item" id="eventos_jogo">
                                <a class="nav-link active" data-toggle="pill" href="#eventos" id="menu1">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#formacao" id="menu2">Formações</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#classificacao" id="menu3">Classificação</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#confrontros" id="menu4">Confrontos</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="eventos" class="container tab-pane active"><br><br><br>
                                <div class="row">
                                    <div class="col-sm" id="logo_kit_equipa_home">
                                        <img src="./logotipos/clubes/'.$game->home_logo_kit.'" id="logo_team_jogo">
                                        <p>Equipamento Principal</p>
                                    </div>
                                    <div class="col-sm" id="logo_kit_equipa_away">
                                        <img src="./logotipos/clubes/'.$game->away_logo_kit.'" id="logo_team_jogo">
                                        <p>Equipamento Alternativo</p>
                                    </div>
                                </div><br><br>';
        /*************************************************************************
        *Começa terreno do jogo jogadores da casa 
        *************************************************************************/
        //defenir jogadores casa
        $stmt_play_game_clashe_casa = $play_game_clashe->searchByGamesinGamePlayer($game->id,"casa");
        $num_play_game_clashe_casa = $stmt_play_game_clashe_casa->rowCount();
        // defenir jogadores em duvida casa
        $stmt_play_game_clashe_casa_duv =$play_game_clashe->searchByGamesinGamePlayer($game->id,"casa");
        $num_play_game_clashe_casa_duv = $stmt_play_game_clashe_casa_duv->rowCount();
        
        // defenir jogadores fora
        $stmt_play_game_clashe_fora = $play_game_clashe->searchByGamesinGamePlayer($game->id,"fora");
        $num_play_game_clashe_fora = $stmt_play_game_clashe_fora->rowCount();
        // defenir jogadores em duvida fora
        $stmt_play_game_clashe_fora_duv =$play_game_clashe->searchByGamesinGamePlayer($game->id,"fora");
        $num_play_game_clashe_fora_duv = $stmt_play_game_clashe_fora_duv->rowCount();

        // defenir treinadores casa
        $man_game_clashe_casa =$man_game_clashe->searchByGamesinGameManager($game->id,"casa");
        $num_man_game_clashe_casa = $man_game_clashe_casa->rowCount();

        // defenir treinadores fora
        $man_game_clashe_fora =$man_game_clashe->searchByGamesinGameManager($game->id,"fora");
        $num_man_game_clashe_fora = $man_game_clashe_fora->rowCount();
        
        if (($num_play_game_clashe_casa > 0) || ($num_play_game_clashe_fora > 0)) { 

            /*****************************************
            * Comeca jogadores de casa 
            ******************************************** */
            $html .='
                                <div class="row" id="terreno_jogo_det">
                                    <div class="col-sm-6" id="col_terreno_casa"><br><br>
                                        <div class="col-sm" id="ant_jogo_casa">
                                            <span>Não vai jogar</span>
                                        </div><br>';

            while ($row_game_clashe_play_casa = $stmt_play_game_clashe_casa->fetch(PDO::FETCH_ASSOC)) {
                if($row_game_clashe_play_casa['punished'] == true){
                    
                    $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="player_casa">
                                                        <img src="./logotipos/jogadores/'.$row_game_clashe_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_clashe_play_casa['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/icons/susp.png" id="item_jogo">
                                                        <p id="txt_player_casa">
                                                            Indisponível 
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>';
                }
                if($row_game_clashe_play_casa['accumulation'] == true){
                    $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/jogadores/'.$row_game_clashe_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_clashe_play_casa['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                            <span  id="txt_player_casa">
                                                                <img src="./logotipos/icons/susp_a.png" id="item_jogo">
                                                                <p id="icons_player_casa">
                                                                Por acumulação de amarelos na liga 
                                                            </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>'; 
                }
                if($row_game_clashe_play_casa['expulsion'] == true){
                    $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="player_casa">
                                                        <img src="./logotipos/jogadores/'.$row_game_clashe_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_clashe_play_casa['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/icons/susp_r.png" id="item_jogo">
                                                        <p id="txt_player_casa">
                                                            Devido a expulsão 
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>';
                }
                if($row_game_clashe_play_casa['injured'] == true){
                    $html .='    
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="player_casa">
                                                        <img src="./logotipos/jogadores/'.$row_game_clashe_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_clashe_play_casa['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa['nickname_player']).'&id='.$row_game_clashe_play_casa['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/icons/les.png" id="item_jogo">
                                                        <p id="txt_player_casa">
                                                            Devido a lesão 
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>';
                }
            }
            /****************************************
            * jogadores em duvida
            *****************************************/
            if ($num_play_game_clashe_casa_duv > 0) { 
                $html .='
                                        <div class="col-sm" id="ant_jogo_casa">
                                            <span>Em dúvida</span>
                                        </div><br>';
                while ($row_game_clashe_play_casa_duv = $stmt_play_game_clashe_casa_duv->fetch(PDO::FETCH_ASSOC)) {
                    if($row_game_clashe_play_casa_duv['doubt'] == true){
                        $html .='    
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">    
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa_duv['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa_duv['nickname_player']).'&id='.$row_game_clashe_play_casa_duv['idplayer'].'"id="a_play">
                                                    <span id="player_casa">
                                                        <img src="./logotipos/jogadores/'.$row_game_clashe_play_casa_duv['photo_player'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_clashe_play_casa_duv['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_casa_duv['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_casa_duv['nickname_player']).'&id='.$row_game_clashe_play_casa_duv['idplayer'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/icons/duv.png" id="item_jogo">
                                                        <p id="txt_player_casa">
                                                            Em dúvida 
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>';
                    }  
                }
            }else{$html .='';}
            /**********************************
            *      Treinadores em casa 
            ***********************************/
            if ($num_man_game_clashe_casa > 0) { 
                $html .='           
                                        <div class="col-sm" id="ant_jogo_casa">
                                            <span>Treinador</span>
                                        </div><br>';
                while ($row_man_game_clashe_casa = $man_game_clashe_casa->fetch(PDO::FETCH_ASSOC)) {
                    if($row_man_game_clashe_casa['punished'] == true){
                        $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_casa['nickname_manager']).'&id='.$row_man_game_clashe_casa['idmanager'].'"id="a_play">
                                                    <span id="player_casa">
                                                        <img src="./logotipos/treinadores/'.$row_man_game_clashe_casa['photo_manager'].'"id="photo_player_jogo"/>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_man_game_clashe_casa['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_casa['nickname_manager']).'&id='.$row_man_game_clashe_casa['idmanager'].'"id="a_play">
                                                    <span id="icons_player_casa">
                                                        <img src="./logotipos/icons/susp.png" id="item_jogo">
                                                        <p id="txt_player_casa">
                                                            Indisponível 
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>';
                    }
                    if($row_man_game_clashe_casa['expulsion'] == true){
                        $html .='
                                            <div class="row" id="row_play_casa">
                                                <div class="col-sm-4" id="col_play_casa">
                                                    <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_casa['nickname_manager']).'&id='.$row_man_game_clashe_casa['idmanager'].'"id="a_play">
                                                        <span id="icons_player_casa">
                                                            <img src="./logotipos/jogadores/'.$row_man_game_clashe_casa['photo_player'].'"id="photo_player_jogo"/>
                                                            <p id="txt_player_casa_name">
                                                                '.$row_man_game_clashe_casa['nickname_player'].'
                                                            </p>
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm" id="col_icons_casa">
                                                    <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_casa['nickname_manager']).'&id='.$row_man_game_clashe_casa['idmanager'].'"id="a_play">
                                                        <span id="icons_player_casa">
                                                            <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_casa['nickname_manager']).'&id='.$row_man_game_clashe_casa['idmanager'].'"id="a_play">
                                                                <span  id="txt_player_casa">
                                                                    <img src="./logotipos/icons/susp_a.png" id="item_jogo">
                                                                    <p id="icons_player_casa">
                                                                    Por acumulação de amarelos na liga 
                                                                </p>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>'; 
                    } 
                }
            }else{ $html .='';}
            /*****************************************
            * Comeca jogadores de fora 
            ******************************************** */
            $html .='
                                            </div> 
                                            <div class="col-sm-6" id="col_terreno_fora"><br><br>
                                                <div class="col-sm" id="ant_jogo_fora">
                                                    <span>Não vai jogar</span>
                                                </div><br>';

            while ($row_game_clashe_play_fora = $stmt_play_game_clashe_fora->fetch(PDO::FETCH_ASSOC)) {
                if($row_game_clashe_play_fora['punished'] == true){
                    
                    $html .='
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                            <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                                <span id="icons_player_fora">
                                                                    <img src="./logotipos/icons/susp.png" id="item_jogo">
                                                                    <p id="txt_player_fora">
                                                                        Indisponível 
                                                                    </p>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-4" id="col_play_fora">
                                                            <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                                <span id="player_fora">
                                                                    <img src="./logotipos/jogadores/'.$row_game_clashe_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                                    <p id="txt_player_fora_name">
                                                                        '.$row_game_clashe_play_fora['nickname_player'].'
                                                                    </p>
                                                                </span>
                                                            </a>
                                                        </div>
                                                </div>';
                }
                if($row_game_clashe_play_fora['accumulation'] == true){
                    $html .='
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/icons/susp_a.png" id="item_jogo">
                                                                <p id="txt_player_fora">
                                                                    Por acumulação de amarelos na liga 
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4" id="col_play_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/jogadores/'.$row_game_clashe_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_game_clashe_play_fora['nickname_player'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>'; 
                }
                if($row_game_clashe_play_fora['expulsion'] == true){
                    $html .='
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/icons/susp_r.png" id="item_jogo">
                                                                <p id="txt_player_fora">
                                                                    Devido a expulsão 
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4" id="col_play_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                            <span id="player_fora">
                                                                <img src="./logotipos/jogadores/'.$row_game_clashe_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_game_clashe_play_fora['nickname_player'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>';
                }
                if($row_game_clashe_play_fora['injured'] == true){
                    $html .='    
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                            <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                                <span id="icons_player_fora">
                                                                    <img src="./logotipos/icons/les.png" id="item_jogo">
                                                                    <p id="txt_player_fora">
                                                                        Devido a lesão
                                                                    </p>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    <div class="col-sm-4" id="col_play_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora['nickname_player']).'&id='.$row_game_clashe_play_fora['idplayer'].'"id="a_play">
                                                            <span id="player_fora">
                                                                <img src="./logotipos/jogadores/'.$row_game_clashe_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_game_clashe_play_fora['nickname_player'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    
                                                </div>';
                }
            }
            /****************************************
             * jogadores em duvida fora
             *****************************************/
            if ($num_play_game_clashe_fora_duv > 0) { 
                $html .='
                                                <div class="col-sm" id="ant_jogo_fora">
                                                    <span>Em dúvida</span>
                                                </div><br>';
                while ($row_game_clashe_play_fora_duv = $stmt_play_game_clashe_fora_duv->fetch(PDO::FETCH_ASSOC)) {
                    if($row_game_clashe_play_fora_duv['doubt'] == true){
                        $html .='    
                                        
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora_duv['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora_duv['nickname_player']).'&id='.$row_game_clashe_play_fora_duv['idplayer'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/icons/duv.png" id="item_jogo">
                                                                <p id="txt_player_fora">
                                                                    Em dúvida 
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4" id="col_play_fora">    
                                                        <a href="?m=jogadores&'.sanitizeString($row_game_clashe_play_fora_duv['name_country']).'&a=jogador&'.sanitizeString($row_game_clashe_play_fora_duv['nickname_player']).'&id='.$row_game_clashe_play_fora_duv['idplayer'].'"id="a_play">
                                                            <span id="player_fora">
                                                                <img src="./logotipos/jogadores/'.$row_game_clashe_play_fora_duv['photo_player'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_game_clashe_play_fora_duv['nickname_player'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>';
                    }  
                }
            }else{$html .='';} 
            /**********************************
            *      Treinadores em fora
            ***********************************/
            if ($num_man_game_clashe_fora > 0) { 
                        $html .='           
                                                <div class="col-sm" id="ant_jogo_fora">
                                                    <span>Treinador</span>
                                                </div><br>';
                while ($row_man_game_clashe_fora = $man_game_clashe_fora->fetch(PDO::FETCH_ASSOC)) {
                    if($row_man_game_clashe_fora['punished'] == true){
                        $html .='
                                                <div class="row" id="row_play_fora">
                                                        <div class="col-sm" id="col_icons_fora">
                                                        <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_fora['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_fora['nickname_manager']).'&id='.$row_man_game_clashe_fora['idmanager'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/icons/susp.png" id="item_jogo">
                                                                <p id="txt_player_fora">
                                                                    Indisponível 
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4" id="col_play_fora">
                                                        <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_fora['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_fora['nickname_manager']).'&id='.$row_man_game_clashe_fora['idmanager'].'"id="a_play">
                                                            <span id="player_fora">
                                                                <img src="./logotipos/treinadores/'.$row_man_game_clashe_fora['photo_manager'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_man_game_clashe_fora['nickname_player'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>';
                    }
                    if($row_man_game_clashe_fora['expulsion'] == true){
                        $html .='
                                                <div class="row" id="row_play_fora">
                                                    <div class="col-sm" id="col_icons_fora">
                                                        <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_casa['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_fora['nickname_manager']).'&id='.$row_man_game_clashe_fora['idmanager'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_fora['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_fora['nickname_manager']).'&id='.$row_man_game_clashe_fora['idmanager'].'"id="a_play">
                                                                    <span  id="txt_player_fora">
                                                                        <img src="./logotipos/icons/susp_r.png" id="item_jogo">
                                                                        <p id="icons_player_fora">
                                                                        Por expulsão 
                                                                    </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-4" id="col_play_fora">
                                                        <a href="?m=treinadores&'.sanitizeString($row_man_game_clashe_fora['name_country']).'&a=treinador&'.sanitizeString($row_man_game_clashe_fora['nickname_manager']).'&id='.$row_man_game_clashe_fora['idmanager'].'"id="a_play">
                                                            <span id="icons_player_fora">
                                                                <img src="./logotipos/treinadores/'.$row_man_game_clashe_fora['photo_manager'].'"id="photo_player_jogo"/>
                                                                <p id="txt_player_fora_name">
                                                                    '.$row_man_game_clashe_fora['nickname_manager'].'
                                                                </p>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>'; 
                    } 
                }


            }else{$html .='';}
        }else{$html .='';} 
        /******************************
         * começa informacoes
         ************************** */  
        $html .='  
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-sm-5" id="player_equipa_jog"></div>
                                            <div class="col-sm" id="player_equipa_joga">Informações da partida</div>
                                            <div class="col-sm-5" id="player_equipa_jog"></div>
                                        </div><br><br>
                                        <div class="row"  id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                    <span>Torneio</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>'.$game->name_competition.'</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                <span>Data de início </span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>'.date('D-M-Y',strtotime($game->date_game));
                                                    
                                                        if($game->date_game <= date('Y-m-d')){
                                                        $html .='<span>'.$game->time_game.'</span>';  
                                                        }
        $html .='                                   </span>
                                            </div>
                                        </div>
                                        <div class="row" id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                <span>Ábritro </span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>
                                                        <img src="./logotipos/icons/apito.png" id="item_jogo"/>  
                                                        Pedro Proença
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row" id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                <span>Média de cartões </span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>
                                                        <img src="./logotipos/icons/yellow_card.png" id="item_jogo"/> 
                                                        0.3
                                                    </span>
                                                    <span>
                                                        <img src="./logotipos/icons/red_card.png" id="item_jogo"/> 
                                                        5.96
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row" id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                <span>Localização</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>'.$game->city.'</span>
                                            </div>
                                        </div>
                                        <div class="row" id="info_row">
                                            <div class="col-sm-5" id="inf_partida">
                                                <span>Televisão</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida"></div>
                                            <div class="col-sm-5" id="inf_partida_det">
                                                    <span>
                                                        <img src="./logotipos/icons/tv.png" id="item_jogo"/> 
                                                        Canal 11
                                                    </span>
                                            </div>
                                        </div><br>';
        /***************************
         * Começa Problabilidades
         * ****************************** */
        $html .='
                                        <div class="row">
                                            <div class="col-sm-5" id="player_equipa_jog"></div>
                                            <div class="col-sm" id="player_equipa_joga">Problabilidades</div>
                                            <div class="col-sm-5" id="player_equipa_jog"></div>
                                        </div><br><br>
                                        <div class="row"  id="info_row">
                                            <div class="col-sm-12">Resultado Final</div>
                                            <div class="col-sm-4" id="prob_txt">1</div>
                                            <div class="col-sm-4" id="prob_txt">X</div>
                                            <div class="col-sm-4" id="prob_txt">2</div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>3.00</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>3.50</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>3.00</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" id="mostrar_mais">
                                                <span id="mostar_mais">mostar mais</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">1º Tempo</div>
                                            <div class="col-sm-4" id="prob_txt">1</div>
                                            <div class="col-sm-4" id="prob_txt">X</div>
                                            <div class="col-sm-4" id="prob_txt">2</div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>4.00</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>4.50</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>4.00</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">Empate Anula</div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob1">1X</span>
                                            </div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob2">2X</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob1">2.50</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob2">2.50</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">Ambas Marcam</div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob1">Sim</span>
                                            </div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob2">Não</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob1">3.50</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob2">3.50</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">1º Equipa a Marcar</div>
                                            <div class="col-sm-4" id="prob_txt">'.$game->home_nickname.'</div>
                                            <div class="col-sm-4" id="prob_txt">Sem Golos</div>
                                            <div class="col-sm-4" id="prob_txt">'.$game->away_nickname.'</div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>2.00</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>4.50</span>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                    <span>2.00</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">Handicap Asiático</div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob1">(-0.75)'.$game->home_nickname.'</span>
                                            </div>
                                            <div class="col-sm-6" id="prob_txt">
                                                <span id="span_txt_prob2">(0.75)'.$game->home_nickname.'</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob1">1.80</span>
                                            </div>
                                            <div class="col-sm-5" id="inf_partida_prob">
                                                <span id="span_prob2">2.50</span>
                                            </div>
                                        </div>
                                        <div class="row"  id="info_row_prob">
                                            <div class="col-sm-12">Golos da Partida</div>
                                            <div class="col-sm-4" id="prob_txt"></div>
                                            <div class="col-sm-4" id="prob_txt">Mais de</div>
                                            <div class="col-sm-4" id="prob_txt">Menos de</div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                <div class="row" id="row_prob_gols">
                                                    <span>0.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>2.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>3.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>4.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>5.5</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>6.5</span>
                                                </div>
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.02</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.10</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.53</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>2.30</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>4.50</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>7.50</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>15.50</span>
                                                </div>   
                                            </div>
                                            <div class="col-sm" id="inf_partida_prob">
                                                <div class="row" id="row_prob_gols">
                                                    <span>17.00</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>5.00</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>2.50</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.61</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.25</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.10</span>
                                                </div>
                                                <div class="row" id="row_prob_gols">
                                                    <span>1.03</span>
                                                </div>  
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-12" id="mostrar_mais">
                                            <span id="minimizar">Minimizar</span>
                                        </div>
                                    </div><br><br>';
        /*******************************
         *  estadio do jogo
         * *****************************/
        
        $html .= '
                                    <div class="row">
                                        <div class="col-sm-5" id="player_equipa_jog"></div>
                                        <div class="col-sm" id="player_equipa_joga">Estádio</div>
                                        <div class="col-sm-5" id="player_equipa_jog"></div>
                                    </div><br><br>
                                    <div class="row" id="stadium_jogo">
                                        <div class="col-sm-6"><br><br>
                                            <p>Capacidade '.$game->capacity.' lugares</p>
                                            <p><p>Cidade de '.$game->city.'</p>
                                            <p><p>Fundado em '.date('Y',$game->foundation).'</p>
                                            <p><p>Campo '.$game->grass_type.'</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <span id="nome_sta">'.$game->name_stadium.'</span>
                                            <p><img src="./logotipos/clubes/'.$game->logo_stadium.'" id="sta_team_jogo"></p>
                                        </div>
                                    </div>
                                    <div class="row" id="row_fund"></div>';
        //fim div menu  
        $html .= '
                                </div>
                                <div id="formacao" class="container tab-pane fade"><br>
                                   

                                </div>
                                <div id="classificacao" class="container tab-pane fade"><br>
                                    bbb

                                </div>
                                <div id="confrontros" class="container tab-pane fade"><br>

                                    cccc
                                </div>
                            </div>
                        </div>
                    </div></div>';
    }else{
        /*****************************************
         * Quando ha golos
         *************************************/
        $html .='
                        <div class="row">
                            <div class="col-sm" id="competicao_pais_jogo">
                                <p>
                                    <a href="?m=competicoes&'.sanitizeString($game->name_country).'&'.sanitizeString($game->competition_type).'&a=torneio&'.sanitizeString($game->name_competition).'&id='.$game->idcompetition.'" id="competicao_pais_jogo">
                                        <img src="./logotipos/competicoes/'.$game->logo_competition.'" id="img_comp_jogo">'
                                        .$game->name_competition.'
                                    </a>
                                </p>
                                <p>
                                        <img src="./logotipos/paises/'.$game->flag_country.'" id="img_pais_jogo">'
                                        .$game->name_country.'
                                </p>
                            </div>
                        </div>
                        <div class="row">';
        // defenir id do pais com o da equipa mesmo nome
        if($game->home_nickname == $game->name_country && $game->away_nickname == $game->name_country ){
            $html .='
                            <div class="col-sm-5" id="team_home_jogo">
                                <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                                    <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                                    <p>'.$game->home_nickname.'</p>
                                </a>
                            </div>
                            <div class="col-sm-2" id="time_jogo">
                                <br>
                                <span id="txt_scores">'.$game->scores_home.' - '.$game->scores_away.'</span>
                            </div>
                            <div class="col-sm-5" id="team_away_jogo">
                                <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa-internacional&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                                    <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                                    <p>'.$game->away_nickname.'</p>
                                </a>
                            </div>';
        //// id da equipa correto
        }else{
            $html .='       
                            <div class="col-sm-5" id="team_home_jogo">
                                <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->home_nickname).'&id='.$game->idteam_home.'" id="team_home_jogo">
                                    <img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo">
                                    <p>'.$game->home_nickname.'</p>
                                </a>
                            </div>
                            <div class="col-sm-2" id="time_jogo">
                                <br>
                                <span id="txt_scores">'.$game->scores_home.' - '.$game->scores_away.'</span>
                            </div>
                            <div class="col-sm-5" id="team_away_jogo">
                                <a href="?m=equipas&'.sanitizeString($game->name_country).'&a=equipa&'.sanitizeString($game->away_nickname).'&id='.$game->idteam_away.'" id="team_away_jogo">
                                    <img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo">
                                    <p>'.$game->away_nickname.'</p>
                                </a>
                            </div>';  
        } 
        $html .=' 
                        </div>
                        <div class="row">
                            <div class="col-sm-5" id="btn_but">';

        /********************************************
        * Seguidores das equipas
        **********************************************/
        // equipa está no favoritos equipa da casa
        $stmt_fav_team_home = $fav_team->searchByUserByTeams($_SESSION['uid'], $game->idteam_home);
        $num_fav_team_home = $stmt_fav_team_home->rowCount();
        if ($num_fav_team_home > 0) {
            // Apresentar conteudos da equipa da casa
            while ($row_fav_team_home = $stmt_fav_team_home->fetch(PDO::FETCH_ASSOC)) {
                if(($row_fav_team_home['iduser'] == $_SESSION['uid']) && ($row_fav_team_home['idteam'] == $game->idteam_home)){
                    $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=eliminar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idfav='.$row_fav_team_home['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>';
                }
            }
        }else{
            if(isset($_SESSION['uid'])){
                $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=adicionar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idteam_jogo='.$game->idteam_home.'" id="a_play">
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
                                                <p><img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo"></p>
                                                <p><h5><strong id="team_mod">'.$game->home_nickname.'</strong></h5></p>
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
        $stmt_fav_seg_home = $fav_seg->searchSegTeam($game->idteam_home);
        // Obter reg de seguidores da equipa da casa
        while ($row_fav_seg_home = $stmt_fav_seg_home->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                                <p id="seg_jog">'.$row_fav_seg_home['seg'].'K
                                    <span id="txt_seg_jog">seguidores</span>
                                </p>
                            </div>';
        }
        $html .='
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5" id="btn_but">';

        // equipa está no favoritos equipa de fora
        $stmt_fav_team_away = $fav_team->searchByUserByTeams($_SESSION['uid'], $game->idteam_away);
        $num_fav_team_away = $stmt_fav_team_away->rowCount();
        if ($num_fav_team_away > 0) {
            // Apresentar conteudos da equipa da fora
            while ($row_fav_team_away = $stmt_fav_team_away->fetch(PDO::FETCH_ASSOC)) {
            
                if(($row_fav_team_away['iduser'] == $_SESSION['uid']) && ($row_fav_team_away['idteam'] == $game->idteam_away)){
                     $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=eliminar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idfav='.$row_fav_team_away['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>';
                }
            }
        }else{

            if(isset($_SESSION['uid'])){
                $html .= '
                                <a href="?m=favoritos&namep='.sanitizeString($game->name_country).'&a=adicionar-equipa&nameteam_h='.sanitizeString($game->home_nickname).'&nameteam_a='.sanitizeString($game->away_nickname).'&idjogo='.$game->id.'&idteam_jogo='.$game->idteam_away.'" id="a_play">
                                    <button id="btn_seguir1">Seguir</button>
                                </a>';
            }else{
                $html .= '    
                                <button data-toggle="modal" data-target="#myModal2" id="btn_seguir1">Seguir</button>
                                <div class="modal fade" id="myModal2">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="modal_prin">
                                            <!-- Modal Header -->
                                            <div class="modal-header" id="header_mod">
                                                <h4 class="modal-title">Para Adicionar Equipa</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body" id="body_mod">
                                                <p><img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo"></p>
                                                <p><h5><strong id="team_mod">'.$game->away_nickname.'</strong></h5></p>
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
        // Obter reg de seguidoresvequipa da fora
        $stmt_fav_seg_away = $fav_seg->searchSegTeam($game->idteam_away);
        // Apresentar conteudos dos paises
        while ($row_fav_seg_away = $stmt_fav_seg_away->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                                <p id="seg_jog">'.$row_fav_seg_away['seg'].'K
                                    <span id="txt_seg_jog">seguidores</span>
                                </p>
                            </div>';
        }
        $html .= '
                </div><br><br>
                <div class="row">
                    <div class="col-sm">
                        <!-- Nav pills -->
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item" id="eventos_jogo">
                                <a class="nav-link active" data-toggle="pill" href="#eventos" id="menu1">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#estatisticas" id="menu2">Estatísticas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#formacao" id="menu3">Formações</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#classificacao" id="menu4">Classificação</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#confrontros" id="menu5">Confrontos</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="eventos" class="container tab-pane active"><br><br><br>
                                <div class="row">
                                    <div class="col-sm" id="logo_kit_equipa_home">
                                        <img src="./logotipos/clubes/'.$game->home_logo_kit.'" id="logo_team_jogo">
                                        <p>Equipamento Principal</p>
                                    </div>
                                    <div class="col-sm" id="logo_kit_equipa_away">
                                        <img src="./logotipos/clubes/'.$game->away_logo_kit.'" id="logo_team_jogo">
                                        <p>Equipamento Alternativo</p>
                                    </div>
                                </div><br><br>';
        /***************************************************************************
         *Começa terreno do jogo jogadores da casa quado existe golos
        ****************************************************************************/
        // Obter ID e detalhes do produto
        $idplayer = filter_input(INPUT_GET, 'idjogador', FILTER_SANITIZE_NUMBER_INT);
        
        // defenir jogadores casa
        $stmt_play_stat = $play_stat->searchByPlayerInGame($idplayer,$game->id);
        $num_play_stat = $stmt_play_stat->rowCount();

        if ($num_play_stat > 0) {
            $html .='
                                <div class="row">
                                    <div class="col-sm"><br>';
            while ($row_play_stat = $stmt_play_stat->fetch(PDO::FETCH_ASSOC)) {
                if($row_play_stat['type_match_result'] == 'casa'){
                    $html .='
                                        <div class="row" id="row_play_sta">
                                            <div class="col-sm">
                                                <a href="?m=jogadores&'.sanitizeString($row_play_stat['name_country']).'&a=jogador&'.sanitizeString($row_play_stat['nickname_player']).'&id='.$row_play_stat['idplayer'].'" id="a_play">
                                                    <img src="./logotipos/jogadores/'.$row_play_stat['photo_player'].'" id="photo_player_jogo">
                                                    <img src="./logotipos/clubes/'.$row_play_stat['logo_team_home'].'" id="logo_team_jogo_sta">
                                                    <p id="span_det">'.$row_play_stat['nickname_player'].'</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row" id="row_sta">
                                            <div class="col-sm">
                                                <span><img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo_sta"></span>
                                            </div>
                                            <div class="col-sm">
                                                <span>'.$game->scores_home.'</span> -
                                                <span>'.$game->scores_away.'</span>
                                            </div>
                                            <div class="col-sm">
                                                <span><img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo_sta"></span>
                                            </div>
                                            <div class="col-sm">
                                                <span>'.date('d-m-Y',strtotime($game->date_game)).'</span>
                                            </div>
                                        </div>';
                    if($row_play_stat['position']== 'GK') {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="sta1">
                                                                <td> <span>Minutos jogados</span></td>
                                                                <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Defesas</span></td>
                                                                <td><span>'.$row_play_stat['defenses'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Socos</span></td>
                                                                <td><span>'.$row_play_stat['punches'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Saídas(êxito)</span></td>
                                                                <td><span>'.$row_play_stat['exits'].'</span>(<span>'.$row_play_stat['successful_exits'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Bolas aéreas reivindicadas</span></td>
                                                                <td><span>'.$row_play_stat['claimed_ai_balls'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Defesas destro da área</span></td>
                                                                <td><span>'.$row_play_stat['defenses_in_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Erros capitais</span></td>
                                                                <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                            <td><span>Toques</span></td>
                                                            <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Passes certos</span></td>
                                                                <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td> <span>Cruzamentros (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td> <span>Bolas longas (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                    <td><span>Assistências</span></td>
                                                                    <td><span>'.$row_play_stat['assist'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Cortes</span></td>
                                                                    <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Remates travados</span></td>
                                                                    <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Intercepções</span></td>
                                                                    <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Desarmes</span></td>
                                                                    <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Dribles sofridos</span></td>
                                                                    <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Duelos no chão (ganhos)</span></td>
                                                                    <td><span>'.$row_play_stat['floor_duels'].'</span> (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Duelos no aéros (ganhos)</span></td>
                                                                    <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Perdas da posse de bola</span></td>
                                                                    <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                                </tr>
                                                                <tr id="sta2">
                                                                    <td><span>Faltas</span></td>
                                                                    <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Faltas sofridas</span></td>
                                                                    <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                                </tr>
                                                                <tr id="sta2">
                                                                    <td><span>Finalizações para golo</span></td>
                                                                    <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Finalizações para fora</span></td>
                                                                    <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Finalizações bloqueadas</span></td>
                                                                    <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Total de remates</span></td>
                                                                    <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Remates dentro da area</span></td>
                                                                    <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Remates fora da area</span></td>
                                                                    <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><br><br><br>';

                    }
                    
                    if(($row_play_stat['position']== 'DD')||($row_play_stat['position']=='DC')||($row_play_stat['position'] == 'DE')) {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="sta1">
                                                                <td> <span>Minutos jogados</span></td>
                                                                <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Golos</span></td>
                                                                <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Assistências</span></td>
                                                                <td><span>'.$row_play_stat['assist'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Cortes</span></td>
                                                                <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Remates travados</span></td>
                                                                <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Intercepções</span></td>
                                                                <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Desarmes</span></td>
                                                                <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Dribles sofridos</span></td>
                                                                <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Duelos no chão (ganhos)</span></td>
                                                                <td><span>'.$row_play_stat['floor_duels'].'</span>
                                                                (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Duelos no aéros (ganhos)</span></td>
                                                                <td><span>'.$row_play_stat['air_duels'].'</span>
                                                                (<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Perdas da posse de bola</span></td>
                                                                <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Faltas</span></td>
                                                                <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Faltas sofridas</span></td>
                                                                <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Toques</span></td>
                                                                <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Passes certos</span></td>
                                                                <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td> <span>Cruzamentros (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td> <span>Bolas longas (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Finalizações para golo</span></td>
                                                                <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Finalizações para fora</span></td>
                                                                <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Finalizações bloqueadas</span></td>
                                                                <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Total de remates</span></td>
                                                                <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Remates dentro da area</span></td>
                                                                <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Remates fora da area</span></td>
                                                                <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Erros capitais</span></td>
                                                                <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><br><br><br>';
                                                        
                    }
                    if(($row_play_stat['position']== 'MDC')||($row_play_stat['position'] =='MCD')||($row_play_stat['position'] == 'MCE')||($row_play_stat['position'] == 'MC')) {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr id="sta1">
                                                            <td><span>Minutos jogados</span></td>
                                                            <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Golos</span></td>
                                                            <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                        </tr>
                                                        <tr id="sta1">
                                                            <td><span>Assistências</span></td>
                                                            <td><span>'.$row_play_stat['assist'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Toques</span></td>
                                                            <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                        </tr>
                                                        <tr id="sta1">
                                                            <td><span>Passes certos</span></td>
                                                            <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td> <span>Cruzamentros (prec.)</span></td>
                                                            <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td> <span>Bolas longas (prec.)</span></td>
                                                            <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Finalizações para golo</span></td>
                                                            <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Finalizações para fora</span></td>
                                                            <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Finalizações bloqueadas</span></td>
                                                            <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Total de remates</span></td>
                                                            <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Remates dentro da area</span></td>
                                                            <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Remates fora da area</span></td>
                                                            <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Tentativas de drible (suced.)</span></td>
                                                            <td><span>'.$row_play_stat['dribbling_attempts'].'</span>(<span>'.$row_play_stat['successful_dribbling_attempts'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Duelos no chão (ganhos)</span></td>
                                                            <td><span>'.$row_play_stat['floor_duels'].'</span>
                                                            (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Duelos no aéros (ganhos)</span></td>
                                                            <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Perdas da posse de bola</span></td>
                                                            <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Faltas</span></td>
                                                            <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Faltas sofridas</span></td>
                                                            <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Cortes</span></td>
                                                            <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Remates travados</span></td>
                                                            <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Intercepções</span></td>
                                                            <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Desarmes</span></td>
                                                            <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Dribles sofridos</span></td>
                                                            <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Erros capitais</span></td>
                                                            <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><br><br><br>';
                    }
                    if(($row_play_stat['position']== 'FW')||($row_play_stat['position'] =='FWR')||($row_play_stat['position'] == 'FWE')) {
                        $html .= '
                                        <div class="row"> 
                                        <div class="col-sm">
                                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                <table class="table table-hover table-bordered table-striped mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr id="sta1">
                                                        <td><span>Minutos jogados</span></td>
                                                        <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Golos</span></td>
                                                        <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                    </tr>
                                                    <tr id="sta1">
                                                        <td><span>Assistências</span></td>
                                                        <td><span>'.$row_play_stat['assist'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Finalizações para golo</span></td>
                                                        <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Finalizações para fora</span></td>
                                                        <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Finalizações bloqueadas</span></td>
                                                        <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                    </tr>
                                                    <tr id="sta1">
                                                        <td><span>Tentativas de drible (suced.)</span></td>
                                                        <td><span>'.$row_play_stat['dribbling_attempts'].'</span>
                                                        (<span>'.$row_play_stat['successful_dribbling_attempts'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Total de remates</span></td>
                                                        <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Remates dentro da area</span></td>
                                                        <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Remates fora da area</span></td>
                                                        <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Toques</span></td>
                                                        <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Passes certos</span></td>
                                                        <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td> <span>Cruzamentros (prec.)</span></td>
                                                        <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Bolas longas (prec.)</span></td>
                                                        <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Duelos no chão (ganhos)</span></td>
                                                        <td><span>'.$row_play_stat['floor_duels'].'</span>(<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                        
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Duelos no aéros (ganhos)</span></td>
                                                        <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Perdas da posse de bola</span></td>
                                                        <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Faltas</span></td>
                                                        <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Faltas sofridas</span></td>
                                                        <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Cortes</span></td>
                                                        <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Remates travados</span></td>
                                                        <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Intercepções</span></td>
                                                        <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Desarmes</span></td>
                                                        <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Dribles sofridos</span></td>
                                                        <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Erros capitais</span></td>
                                                        <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br><br><br>';
                    }
                }else{
                    $html .= '';
                }
                if($row_play_stat['type_match_result'] == 'fora'){
                    $html .='
                                        <div class="row" id="row_play_sta">
                                            <div class="col-sm">      
                                                <a href="?m=jogadores&'.sanitizeString($row_play_stat['name_country']).'&a=jogador&'.sanitizeString($row_play_stat['nickname_player']).'&id='.$row_play_stat['idplayer'].'" id="a_play">
                                                    <img src="./logotipos/jogadores/'.$row_play_stat['photo_player'].'" id="photo_player_jogo">
                                                    <img src="./logotipos/clubes/'.$row_play_stat['logo_team_away'].'" id="logo_team_jogo_sta">
                                                    <p id="span_det">'.$row_play_stat['nickname_player'].'</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row" id="row_sta">
                                            <div class="col-sm">
                                                <span><img src="./logotipos/clubes/'.$game->home_logo_team.'" id="logo_team_jogo_sta"></span>
                                            </div>
                                            <div class="col-sm">
                                                <span>'.$game->scores_home.'</span> -
                                                <span>'.$game->scores_away.'</span>
                                            </div>
                                            <div class="col-sm">
                                                <span><img src="./logotipos/clubes/'.$game->away_logo_team.'" id="logo_team_jogo_sta"></span>
                                            </div>
                                            <div class="col-sm">
                                                <span>'.date('d-m-Y',strtotime($game->date_game)).'</span>
                                            </div>
                                        </div>';
                    if($row_play_stat['position']== 'GK') {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="sta1">
                                                                <td> <span>Minutos jogados</span></td>
                                                                <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Defesas</span></td>
                                                                <td><span>'.$row_play_stat['defenses'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Socos</span></td>
                                                                <td><span>'.$row_play_stat['punches'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Saídas(êxito)</span></td>
                                                                <td><span>'.$row_play_stat['exits'].'</span>(<span>'.$row_play_stat['successful_exits'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Bolas aéreas reivindicadas</span></td>
                                                                <td><span>'.$row_play_stat['claimed_ai_balls'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Defesas destro da área</span></td>
                                                                <td><span>'.$row_play_stat['defenses_in_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Erros capitais</span></td>
                                                                <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                            <td><span>Toques</span></td>
                                                            <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Passes certos</span></td>
                                                                <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td> <span>Cruzamentros (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td> <span>Bolas longas (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                    <td><span>Assistências</span></td>
                                                                    <td><span>'.$row_play_stat['assist'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Cortes</span></td>
                                                                    <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Remates travados</span></td>
                                                                    <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Intercepções</span></td>
                                                                    <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Desarmes</span></td>
                                                                    <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Dribles sofridos</span></td>
                                                                    <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Duelos no chão (ganhos)</span></td>
                                                                    <td><span>'.$row_play_stat['floor_duels'].'</span> (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                                </tr>
                                                                <tr id="sta1">
                                                                    <td><span>Duelos no aéros (ganhos)</span></td>
                                                                    <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Perdas da posse de bola</span></td>
                                                                    <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                                </tr>
                                                                <tr id="sta2">
                                                                    <td><span>Faltas</span></td>
                                                                    <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Faltas sofridas</span></td>
                                                                    <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                                </tr>
                                                                <tr id="sta2">
                                                                    <td><span>Finalizações para golo</span></td>
                                                                    <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Finalizações para fora</span></td>
                                                                    <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Finalizações bloqueadas</span></td>
                                                                    <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Total de remates</span></td>
                                                                    <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta2">
                                                                    <td><span>Remates dentro da area</span></td>
                                                                    <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                                </tr>
                                                                <tr  id="sta1">
                                                                    <td><span>Remates fora da area</span></td>
                                                                    <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><br><br><br>';
                    }
                    
                    if(($row_play_stat['position']== 'DD')||($row_play_stat['position']=='DC')||($row_play_stat['position'] == 'DE')) {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr id="sta1">
                                                                <td> <span>Minutos jogados</span></td>
                                                                <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Golos</span></td>
                                                                <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Assistências</span></td>
                                                                <td><span>'.$row_play_stat['assist'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Cortes</span></td>
                                                                <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Remates travados</span></td>
                                                                <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Intercepções</span></td>
                                                                <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Desarmes</span></td>
                                                                <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Dribles sofridos</span></td>
                                                                <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Duelos no chão (ganhos)</span></td>
                                                                <td><span>'.$row_play_stat['floor_duels'].'</span>
                                                                (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Duelos no aéros (ganhos)</span></td>
                                                                <td><span>'.$row_play_stat['air_duels'].'</span>
                                                                (<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Perdas da posse de bola</span></td>
                                                                <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                            </tr>
                                                            <tr id="sta2">
                                                                <td><span>Faltas</span></td>
                                                                <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Faltas sofridas</span></td>
                                                                <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Toques</span></td>
                                                                <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Passes certos</span></td>
                                                                <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td> <span>Cruzamentros (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td> <span>Bolas longas (prec.)</span></td>
                                                                <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                            </tr>
                                                            <tr id="sta1">
                                                                <td><span>Finalizações para golo</span></td>
                                                                <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Finalizações para fora</span></td>
                                                                <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Finalizações bloqueadas</span></td>
                                                                <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Total de remates</span></td>
                                                                <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Remates dentro da area</span></td>
                                                                <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta2">
                                                                <td><span>Remates fora da area</span></td>
                                                                <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                            </tr>
                                                            <tr  id="sta1">
                                                                <td><span>Erros capitais</span></td>
                                                                <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><br><br><br>';
                                                        
                    }
                    if(($row_play_stat['position']== 'MDC')||($row_play_stat['position'] =='MCD')||($row_play_stat['position'] == 'MCE')||($row_play_stat['position'] == 'MC')) {
                        $html .='   
                                        <div class="row"> 
                                            <div class="col-sm">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-bordered table-striped mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr id="sta1">
                                                            <td><span>Minutos jogados</span></td>
                                                            <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Golos</span></td>
                                                            <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                        </tr>
                                                        <tr id="sta1">
                                                            <td><span>Assistências</span></td>
                                                            <td><span>'.$row_play_stat['assist'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Toques</span></td>
                                                            <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                        </tr>
                                                        <tr id="sta1">
                                                            <td><span>Passes certos</span></td>
                                                            <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td> <span>Cruzamentros (prec.)</span></td>
                                                            <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td> <span>Bolas longas (prec.)</span></td>
                                                            <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Finalizações para golo</span></td>
                                                            <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Finalizações para fora</span></td>
                                                            <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Finalizações bloqueadas</span></td>
                                                            <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Total de remates</span></td>
                                                            <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta2">
                                                            <td><span>Remates dentro da area</span></td>
                                                            <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Remates fora da area</span></td>
                                                            <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Tentativas de drible (suced.)</span></td>
                                                            <td><span>'.$row_play_stat['dribbling_attempts'].'</span>(<span>'.$row_play_stat['successful_dribbling_attempts'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Duelos no chão (ganhos)</span></td>
                                                            <td><span>'.$row_play_stat['floor_duels'].'</span>
                                                            (<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Duelos no aéros (ganhos)</span></td>
                                                            <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Perdas da posse de bola</span></td>
                                                            <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Faltas</span></td>
                                                            <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Faltas sofridas</span></td>
                                                            <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Cortes</span></td>
                                                            <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Remates travados</span></td>
                                                            <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Intercepções</span></td>
                                                            <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Desarmes</span></td>
                                                            <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                        </tr>
                                                        <tr id="sta2">
                                                            <td><span>Dribles sofridos</span></td>
                                                            <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                        </tr>
                                                        <tr  id="sta1">
                                                            <td><span>Erros capitais</span></td>
                                                            <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><br><br>';
                    }
                    if(($row_play_stat['position']== 'FW')||($row_play_stat['position'] =='FWR')||($row_play_stat['position'] == 'FWE')) {
                        $html .= '
                                        <div class="row"> 
                                        <div class="col-sm">
                                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                <table class="table table-hover table-bordered table-striped mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr id="sta1">
                                                        <td><span>Minutos jogados</span></td>
                                                        <td><span>'.$row_play_stat['minutes_played'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Golos</span></td>
                                                        <td><span>'.$row_play_stat['goals_scored'].'</span></td>
                                                    </tr>
                                                    <tr id="sta1">
                                                        <td><span>Assistências</span></td>
                                                        <td><span>'.$row_play_stat['assist'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Finalizações para golo</span></td>
                                                        <td><span>'.$row_play_stat['goal_strikes'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Finalizações para fora</span></td>
                                                        <td><span>'.$row_play_stat['goal_strikes_out'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Finalizações bloqueadas</span></td>
                                                        <td><span>'.$row_play_stat['shots_blocked'].'</span></td>
                                                    </tr>
                                                    <tr id="sta1">
                                                        <td><span>Tentativas de drible (suced.)</span></td>
                                                        <td><span>'.$row_play_stat['dribbling_attempts'].'</span>
                                                        (<span>'.$row_play_stat['successful_dribbling_attempts'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Total de remates</span></td>
                                                        <td><span>'.$row_play_stat['shots_total'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Remates dentro da area</span></td>
                                                        <td><span>'.$row_play_stat['shots_inside_box'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Remates fora da area</span></td>
                                                        <td><span>'.$row_play_stat['shots_outside_box'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Toques</span></td>
                                                        <td><span>'.$row_play_stat['touches_ball'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Passes certos</span></td>
                                                        <td><span>'.$row_play_stat['passes_right'].'</span>(<span>'.$row_play_stat['passes_right_percentage'].'%</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td> <span>Cruzamentros (prec.)</span></td>
                                                        <td><span>'.$row_play_stat['crossings'].'</span>(<span>'.$row_play_stat['precise_crossings'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta2">
                                                        <td><span>Bolas longas (prec.)</span></td>
                                                        <td><span>'.$row_play_stat['long_balls'].'</span>(<span>'.$row_play_stat['precise_long_balls'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Duelos no chão (ganhos)</span></td>
                                                        <td><span>'.$row_play_stat['floor_duels'].'</span>(<span>'.$row_play_stat['won_floor_duels'].'</span>)</td>
                                                        
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Duelos no aéros (ganhos)</span></td>
                                                        <td><span>'.$row_play_stat['air_duels'].'</span>(<span>'.$row_play_stat['won_air_duels'].'</span>)</td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Perdas da posse de bola</span></td>
                                                        <td><span>'.$row_play_stat['loss_of_possession'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Faltas</span></td>
                                                        <td><span>'.$row_play_stat['fouls_committed'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Faltas sofridas</span></td>
                                                        <td><span>'.$row_play_stat['fouls_suffered'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Cortes</span></td>
                                                        <td><span>'.$row_play_stat['cut_balls'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Remates travados</span></td>
                                                        <td><span>'.$row_play_stat['shots_saved'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Intercepções</span></td>
                                                        <td><span>'.$row_play_stat['interceptions'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Desarmes</span></td>
                                                        <td><span>'.$row_play_stat['tackles'].'</span></td>
                                                    </tr>
                                                    <tr id="sta2">
                                                        <td><span>Dribles sofridos</span></td>
                                                        <td><span>'.$row_play_stat['dribbling_suffered'].'</span></td>
                                                    </tr>
                                                    <tr  id="sta1">
                                                        <td><span>Erros capitais</span></td>
                                                        <td><span>'.$row_play_stat['capital_errors'].'</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br>';

                    }

                }
                $html .='
                                    <div class="col-sm" id="det_col">
                                        <a href="?m=jogadores&'.sanitizeString($row_play_stat['name_country']).'&a=jogador&'.sanitizeString($row_play_stat['nickname_player']).'&id='.$row_play_stat['idplayer'].'" id="a_play">
                                            <span id="span_det">Detalhes do jogador</span>
                                        </a></div>';
            }
            /**********************************************
             * fim da col e da row fim das estatisticas
             * *********************************************/
            $html .='
                            </div>
                        </div><br><br>';
        }else{
            $html.= '';
        }

        


        // defenir jogadores casa
        $stmt_game_mat_play_casa = $game_mat_play->read();
        $num_game_mat_play_casa = $stmt_game_mat_play_casa->rowCount();

        //defenir jogadores melhores em campo casa
        $stmt_game_mat_play_casa_of_match = $game_mat_play->read();
        $num_game_mat_play_casa_of_match = $stmt_game_mat_play_casa_of_match->rowCount();

        //defenir jogadores fora
        $stmt_game_mat_play_fora = $game_mat_play->read();
        $num_game_mat_play_fora = $stmt_game_mat_play_fora->rowCount();

        //defenir jogadores melhores em campo fora
        $stmt_game_mat_play_fora_of_match = $game_mat_play->read();
        $num_game_mat_play_fora_of_match = $stmt_game_mat_play_fora_of_match->rowCount();

        if (($num_game_mat_play_casa > 0) || ($num_game_mat_play_fora > 0)) {
            /**********************************
            * Comeca jogadores de casa  
            ******************************** */
            $html .='
                                <div class="row" id="terreno_jogo_det"><br>
                                    <div class="col-sm-6" id="col_terreno_casa">';
            
             /*************************
             * jogador melhor em campo casa
             * **************************/
            if ($num_game_mat_play_casa_of_match > 0)  {
                while ($row_game_mat_play_casa_of_match = $stmt_game_mat_play_casa_of_match->fetch(PDO::FETCH_ASSOC)) {
                    if($game->id == $row_game_mat_play_casa_of_match['idgame_clashe']){
                        /***************jogadores da equipa de casa********************/
                        if($row_game_mat_play_casa_of_match['type_match_result'] == "casa"){
                            
                            if($row_game_mat_play_casa_of_match['player_of_match'] == true){
                                $html .=' 
                                        <div class="row" id="row_play_fora">
                                            <div class="col-sm-4" id="col_play_fora">
                                                <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora_of_match['nickname_player']).'&idjogador='.$row_game_mat_play_fora_of_match['idplayer'].'&id='.$game->id.'" id="a_play">
                                                    <span id="player_fora">  
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_fora_of_match['photo_player'].'" id="photo_player_jogo"/>
                                                        <p id="txt_player_fora_name">
                                                            '.$row_game_mat_play_fora_of_match['nickname_player'].'
                                                        </p>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-sm-4" id="col_play_fora">
                                                <div id="retangulo">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora_of_match['nickname_player']).'&idjogador='.$row_game_mat_play_fora_of_match['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <span id="pla_macth_span">'.$row_game_mat_play_fora_of_match['rating_perfomance'].'</span>
                                                        <img src="./logotipos/icons/star2.png" id="star_jogo"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>';
                            }
                        }
                    }
                }
            }else{$html .='';}

            while ($row_game_mat_play_casa = $stmt_game_mat_play_casa->fetch(PDO::FETCH_ASSOC)) {
                if($game->id == $row_game_mat_play_casa['idgame_clashe']){
                    /***************jogadores da equipa da casa*********************/
                    if($row_game_mat_play_casa['type_match_result'] == "casa"){
                        /************jogadores no onze 'titulares'***************************/
                        if($row_game_mat_play_casa['initial_eleven'] == true){
                            /********* Quando sao substituidos*******************/
                            if($row_game_mat_play_casa['subs_out'] != 0){
                                $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <span id="player_casa">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_casa['nickname_player']).'&idjogador='.$row_game_mat_play_casa['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <div id="retangulo">
                                                            '.$row_game_mat_play_casa['rating_perfomance'].'
                                                        </div>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_mat_play_casa['nickname_player'].'
                                                        </p>
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/out.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['subs_out'].'min 
                                                    </p>
                                                </span>
                                            </div>';

                                if($row_game_mat_play_casa['yellow_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['red_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['assis'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/assis_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['goals_scored'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                $html .='
                                        </div>';  
                            /************quando nao sao substituidos******************************** */
                            }else{
                                if(($row_game_mat_play_casa['yellow_card'] != 0) || ($row_game_mat_play_casa['red_card'] != 0) || ($row_game_mat_play_casa['assis'] != 0) || ($row_game_mat_play_casa['goals_scored'] != 0)){
                                    $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <span id="player_casa"> 
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_casa['nickname_player']).'&idjogador='.$row_game_mat_play_casa['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_casa['photo_player'].'"id="photo_player_jogo"/>
                                                        <div id="retangulo">
                                                            '.$row_game_mat_play_casa['rating_perfomance'].'
                                                        </div>
                                                        <p id="txt_player_casa_name"> 
                                                            '.$row_game_mat_play_casa['nickname_player'].'
                                                        </p>
                                                    </a>
                                                </span>
                                            </div>';

                                    if($row_game_mat_play_casa['yellow_card'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_casa['red_card'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_casa['assis'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/assis.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_casa['goals_scored'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    $html .='
                                        </div>';
                                
                                }
                            }
                        /*******************quando os suplentes entram****************************/   
                        }else{
                            if($row_game_mat_play_casa['subs_entry'] != 0){
                                $html .='
                                        <div class="row" id="row_play_casa">
                                            <div class="col-sm-4" id="col_play_casa">
                                                <span id="player_casa">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_casa['nickname_player']).'&idjogador='.$row_game_mat_play_casa['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_casa['photo_player'].'" id="photo_player_jogo"/>
                                                        <div id="retangulo">
                                                            '.$row_game_mat_play_casa['rating_perfomance'].'
                                                        </div>
                                                        <p id="txt_player_casa_name">
                                                            '.$row_game_mat_play_casa['nickname_player'].'
                                                        </p>
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/entry.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['subs_entry'].'min 
                                                    </p>
                                                </span>
                                            </div>';

                                if($row_game_mat_play_casa['yellow_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['red_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['assis'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/assis_card.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_marow_game_mat_play_casat_play['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_casa['goals_scored'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_casa">
                                                <span id="icons_player_casa">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_casa">
                                                        '.$row_game_mat_play_casa['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                $html .='
                                        </div>';  
                            }
                        }
                    }
                } 
            }
            $html .='
                                    </div>';
            /*******************************************************************************************************
            * ****Termina jogadores da casa*******Começa jogadores de fora*****
            *****************************************************************************************************************/
            $html .='
                                    <div class="col-sm-6" id="col_play_fora">';

            /*************************
             * jogador melhor em campo fora
             * **************************/
            if ($num_game_mat_play_fora_of_match > 0)  {
                while ($row_game_mat_play_fora_of_match = $stmt_game_mat_play_fora_of_match->fetch(PDO::FETCH_ASSOC)) {
                    if($game->id == $row_game_mat_play_fora_of_match['idgame_clashe']){
                        /***************jogadores da equipa de fora********************/
                        if($row_game_mat_play_fora_of_match['type_match_result'] == "fora"){
                            
                            if($row_game_mat_play_fora_of_match['player_of_match'] == true){
                                $html .=' 
                                        <div class="row" id="row_play_fora">
                                            <div class="col-sm-4" id="col_play_fora">
                                            <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora_of_match['nickname_player']).'&idjogador='.$row_game_mat_play_fora_of_match['idplayer'].'&id='.$game->id.'" id="a_play">
                                                <span id="player_fora">  
                                                    <img src="./logotipos/jogadores/'.$row_game_mat_play_fora_of_match['photo_player'].'" id="photo_player_jogo"/>
                                                    <p id="txt_player_fora_name">
                                                        '.$row_game_mat_play_fora_of_match['nickname_player'].'
                                                    </p>
                                                </span>
                                            </a>
                                            </div>
                                            <div class="col-sm-4" id="col_play_fora">
                                                <div id="retangulo">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora_of_match['nickname_player']).'&idjogador='.$row_game_mat_play_fora_of_match['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <span id="pla_macth_span">'.$row_game_mat_play_fora_of_match['rating_perfomance'].'</span>
                                                        <img src="./logotipos/icons/star2.png" id="star_jogo"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>';
                            }
                        }
                    }
                }
            }else{$html .='';}
            /**************************
             *jogadores fora informacoes 
             * **************** */
            while ($row_game_mat_play_fora = $stmt_game_mat_play_fora->fetch(PDO::FETCH_ASSOC)) {
                if($game->id == $row_game_mat_play_fora['idgame_clashe']){
                    /***************jogadores da equipa de fora********************/
                    if($row_game_mat_play_fora['type_match_result'] == "fora"){
                        
                        /************jogadores no onze 'titulares'***************************/
                        if($row_game_mat_play_fora['initial_eleven'] == true){
                            /********* Quando sao substituidos*******************/
                            if($row_game_mat_play_fora['subs_out'] != 0){
                                $html .='
                                        <div class="row" id="row_play_fora">';

                                if($row_game_mat_play_fora['goals_scored'] != 0){
                                    $html .=' 
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_fora['assis'] != 0){
                                    $html .='
                                            <div class="col-s" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/assis_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_fora['red_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                } 
                                if($row_game_mat_play_fora['yellow_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/out.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['subs_out'].'min 
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="col-sm-4" id="col_play_fora">
                                                <span id="player_fora">  
                                                    <img src="./logotipos/jogadores/'.$row_game_mat_play_fora['photo_player'].'" id="photo_player_jogo"/>
                                                    <div id="retangulo">
                                                        '.$row_game_mat_play_fora['rating_perfomance'].'
                                                    </div>
                                                    <p id="txt_player_fora_name">
                                                        '.$row_game_mat_play_fora['nickname_player'].'
                                                    </p>
                                                </span>
                                            </div>
                                        </div>';
                            /************quando nao sao substituidos******************************** */
                            }else{
                                if(($row_game_mat_play_fora['yellow_card'] != 0) || ($row_game_mat_play_fora['red_card'] != 0) || ($row_game_mat_play_fora['assis'] != 0) || ($row_game_mat_play_fora['goals_scored'] != 0)){
                                    $html .='
                                        <div class="row" id="row_play_fora">';

                                    if($row_game_mat_play_fora['goals_scored'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_fora['assis'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/assis.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_fora['red_card'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    if($row_game_mat_play_fora['yellow_card'] != 0){
                                        $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                    }
                                    $html .='
                                            <div class="col-sm-4" id="col_play_fora">
                                                <span id="player_fora">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora['nickname_player']).'&idjogador='.$row_game_mat_play_fora['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                        <div id="retangulo">
                                                            '.$row_game_mat_play_fora['rating_perfomance'].'
                                                        </div>
                                                    
                                                        <p id="txt_player_fora_name">
                                                            '.$row_game_mat_play_fora['nickname_player'].'
                                                        </p>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>';
                                    
                                }
                            }
                        /*******************quando os suplentes entram****************************/   
                        }else{
                            if($row_game_mat_play_fora['subs_entry'] != 0){
                                $html .='
                                        <div class="row" id="row_play_fora">';
                                if($row_game_mat_play_fora['goals_scored'] != 0){
                                    $html .=' 
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/bola1.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_goals'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_fora['assis'] != 0){
                                    $html .=' 
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/assis_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_assis'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_fora['yellow_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/yellow_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_yellow'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                if($row_game_mat_play_fora['red_card'] != 0){
                                    $html .='
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/red_card.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['minutes_red'].'min 
                                                    </p>
                                                </span>
                                            </div>';
                                }
                                $html .='   
                                            <div class="col-sm" id="col_icons_fora">
                                                <span id="icons_player_fora">
                                                    <img src="./logotipos/icons/entry.png" id="item_jogo">
                                                    <p id="txt_player_fora">
                                                        '.$row_game_mat_play_fora['subs_entry'].'min 
                                                    </p>
                                                </span>
                                            </div>
                                            <div class="col-sm-4" id="col_play_fora">
                                                <span id="player_fora">
                                                    <a href="?m='.$module.'&a='.$action.'&'.sanitizeString($row_game_mat_play_fora['nickname_player']).'&idjogador='.$row_game_mat_play_fora['idplayer'].'&id='.$game->id.'" id="a_play">
                                                        <img src="./logotipos/jogadores/'.$row_game_mat_play_fora['photo_player'].'"id="photo_player_jogo"/>
                                                        <div id="retangulo">
                                                            '.$row_game_mat_play_fora['rating_perfomance'].'
                                                        </div>
                                                        <p id="txt_player_fora_name" name="'.$row_game_mat_play_fora['idplayer'].'"  value="'.$row_game_mat_play_fora['idplayer'].'">
                                                            '.$row_game_mat_play_fora['nickname_player'].'
                                                        </p>
                                                    </a>
                                                </span>
                                            </div>';
                                
                                
                                $html .='
                                        </div>';  
                            }
                        }
                    }
                } 
            }
            $html .='
                                    </div>
                                </div>';
        }else{
            $html .= '';
        }
        /***************************
         * Começa Problabilidades
         * ****************************** */
        $html .='
                                <div class="row">
                                    <div class="col-sm-5" id="player_equipa_jog"></div>
                                    <div class="col-sm" id="player_equipa_joga">Problabilidades</div>
                                    <div class="col-sm-5" id="player_equipa_jog"></div>
                                </div><br><br>
                                <div class="row"  id="info_row">
                                    <div class="col-sm-12">Resultado Final</div>
                                    <div class="col-sm-4" id="prob_txt">1</div>
                                    <div class="col-sm-4" id="prob_txt">X</div>
                                    <div class="col-sm-4" id="prob_txt">2</div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>3.00</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>3.50</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>3.00</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="mostrar_mais">
                                        <span id="mostar_mais">mostar mais</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">1º Tempo</div>
                                    <div class="col-sm-4" id="prob_txt">1</div>
                                    <div class="col-sm-4" id="prob_txt">X</div>
                                    <div class="col-sm-4" id="prob_txt">2</div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>4.00</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>4.50</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>4.00</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">Empate Anula</div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob1">1X</span>
                                    </div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob2">2X</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob1">2.50</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob2">2.50</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">Ambas Marcam</div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob1">Sim</span>
                                    </div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob2">Não</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob1">3.50</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob2">3.50</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">1º Equipa a Marcar</div>
                                    <div class="col-sm-4" id="prob_txt">'.$game->home_nickname.'</div>
                                    <div class="col-sm-4" id="prob_txt">Sem Golos</div>
                                    <div class="col-sm-4" id="prob_txt">'.$game->away_nickname.'</div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>2.00</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>4.50</span>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                            <span>2.00</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">Handicap Asiático</div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob1">(-0.75)'.$game->home_nickname.'</span>
                                    </div>
                                    <div class="col-sm-6" id="prob_txt">
                                        <span id="span_txt_prob2">(0.75)'.$game->home_nickname.'</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob1">1.80</span>
                                    </div>
                                    <div class="col-sm-5" id="inf_partida_prob">
                                        <span id="span_prob2">2.50</span>
                                    </div>
                                </div>
                                <div class="row"  id="info_row_prob">
                                    <div class="col-sm-12">Golos da Partida</div>
                                    <div class="col-sm-4" id="prob_txt"></div>
                                    <div class="col-sm-4" id="prob_txt">Mais de</div>
                                    <div class="col-sm-4" id="prob_txt">Menos de</div>
                                    <div class="col-sm" id="inf_partida_prob">
                                        <div class="row" id="row_prob_gols">
                                            <span>0.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>2.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>3.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>4.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>5.5</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>6.5</span>
                                        </div>
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                        <div class="row" id="row_prob_gols">
                                            <span>1.02</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.10</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.53</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>2.30</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>4.50</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>7.50</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>15.50</span>
                                        </div>   
                                    </div>
                                    <div class="col-sm" id="inf_partida_prob">
                                        <div class="row" id="row_prob_gols">
                                            <span>17.00</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>5.00</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>2.50</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.61</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.25</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.10</span>
                                        </div>
                                        <div class="row" id="row_prob_gols">
                                            <span>1.03</span>
                                        </div>  
                                    </div>
                                    
                                </div>
                                <div class="row">
                                <div class="col-sm-12" id="mostrar_mais">
                                    <span id="minimizar">Minimizar</span>
                                </div>
                            </div><br><br>';
        /*******************************
         *  estadio do jogo
         * *****************************/
        $html .= '
                            <div class="row">
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                                <div class="col-sm" id="player_equipa_joga">Estádio</div>
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                            </div><br><br>
                            <div class="row" id="stadium_jogo">
                                <div class="col-sm-6"><br><br>
                                    <p>Capacidade '.$game->capacity.' lugares</p>
                                    <p><p>Cidade de '.$game->city.'</p>
                                    <p><p>Fundado em '.date('Y',$game->foundation).'</p>
                                    <p><p>Campo '.$game->grass_type.'</p>
                                </div>
                                <div class="col-sm-6">
                                    <span id="nome_sta">'.$game->name_stadium.'</span>
                                    <p><img src="./logotipos/clubes/'.$game->logo_stadium.'" id="sta_team_jogo"></p>
                                </div>
                            </div>
                            <div class="row" id="row_fund"></div>';
        //fim div menu conteiner eventos  
        $html .= '
                        </div>
                        <div id="estatisticas" class="container tab-pane fade"><br><br><br>';
                            
        
        // defenir estatisticas
        $stmt_team_stat = $team_stat->search($game->id);
        $num_team_stat = $stmt_team_stat->rowCount();
        if($num_team_stat > 0){
            $html .= ' 
                            <div class="row">
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                                <div class="col-sm" id="player_equipa_joga">Estatísticas das equipas</div>
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                            </div><br><br>
                            <div class="row" id="terreno_jogo_stat">
                                <div class="col-sm">';
            while ($row_team_stat = $stmt_team_stat->fetch(PDO::FETCH_ASSOC)) {
                $html .= '
                                    <div class="row">
                                        <div class="col-sm">
                                            <span><img src="./logotipos/clubes/'.$row_team_stat['logo_team_home'].'" id="logo_team_jogo_sta"></span>
                                            <p>'.$row_team_stat['nickname_team_home'].'</p>
                                        </div>
                                        <div class="col-sm">
                                            <span>'.$game->scores_home.'</span>
                                            -
                                            <span>'.$game->scores_away.'</span>
                                        </div>
                                        <div class="col-sm">
                                            <span><img src="./logotipos/clubes/'.$row_team_stat['logo_team_away'].'" id="logo_team_jogo_sta"></span>
                                            <p>'.$row_team_stat['nickname_team_away'].'</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span>Posse de bola</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:'.$row_team_stat['ball_possession_home'].'%">'.$row_team_stat['ball_possession_home'].'%</div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div  class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:'.$row_team_stat['ball_possession_away'].'%">'.$row_team_stat['ball_possession_away'].'%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span>Oportunidades de golos</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:'.$row_team_stat['goal_opportunities_home'].'%">'.$row_team_stat['goal_opportunities_home'].'</div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:'.$row_team_stat['goal_opportunities_away'].'%">'.$row_team_stat['goal_opportunities_away'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span>Cantos</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:'.$row_team_stat['corners_home'].'%">'.$row_team_stat['corners_home'].'</div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div  class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:'.$row_team_stat['corners_away'].'%">'.$row_team_stat['corners_away'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <span>Contra-Ataques</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:'.$row_team_stat['counterattacks_home'].'%">'.$row_team_stat['counterattacks_home'].'</div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="progress">
                                                <div  class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:'.$row_team_stat['counterattacks_away'].'%">'.$row_team_stat['counterattacks_away'].'</div>
                                            </div>
                                        </div>
                                    </div>';
            }


        }else{
            $html .= '';
        }
        
        
        /*****************************
         * fim do menu estatisticas
         * ************************** */
        $html .= '          
                                </div>
                            </div>
                        </div>
                        <div id="formacao" class="container tab-pane fade"><br><br>';
        /*************************
         * Formaçoes
         * ****************** */
        $stmt_game_mat_play_form_casa =$game_mat_play->search($game->id);
        $num_game_mat_play_form_casa = $stmt_game_mat_play_form_casa->rowCount();

        $stmt_game_mat_play_form_fora =$game_mat_play->search($game->id);
        $num_game_mat_play_form_fora = $stmt_game_mat_play_form_fora->rowCount();
        
        if (($num_game_mat_play_form_casa > 0)||($num_game_mat_play_form_fora > 0)) { 

            /*****************************************
            * Comeca jogadores de casa 
            ******************************************** */
          
            $html .= ' 
                            <div class="row">
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                                <div class="col-sm" id="player_equipa_joga">Formações</div>
                                <div class="col-sm-5" id="player_equipa_jog"></div>
                            </div><br><br>
                            <div class="row" id="terreno_jogo">
                                <div class="col-sm-6" id="col_terreno_casa">';

            while ($row_game_mat_play_form_casa = $stmt_game_mat_play_form_casa->fetch(PDO::FETCH_ASSOC)) {
                if($row_game_mat_play_form_casa['type_match_result'] == 'casa'){
                    if($row_game_mat_play_form_casa['initial_eleven'] == true){
                        if($row_game_mat_play_form_casa['formation_home'] == '4-4-2'){
                           
                           
                            $html .= '
                                    <div class="row">';
                                        
                            if($row_game_mat_play_form_casa['position'] == 'GK'){ 
                                $html .= ' 
                                            <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_a'].'" id="photo_player_jogo"/>
                                            </div>';
                            }  
                            $html .= '';
                            if($row_game_mat_play_form_casa['position'] == 'DE'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            }  
                            if($row_game_mat_play_form_casa['position'] == 'DC'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            }
                            if($row_game_mat_play_form_casa['position'] == 'DD'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            }  
                            if($row_game_mat_play_form_casa['position'] == 'MD'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_casa['position'] == 'MC'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_casa['position'] == 'ME'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_casa['position'] == 'FW'){ 
                                $html .= ' <div class="col-sm" id="col_play_casa">
                                                <img src="./logotipos/clubes/'.$row_game_mat_play_form_casa['logo_kit_home'].'" id="photo_player_jogo"/>
                                            </div>';
                            }          
                           


                        $html .= '</div>';    
                        }
                        
                                        

                    }
                }
            }
         $html .= '
                                </div>
                            <div class="col-sm-6" id="col_terreno_fora">';
         /*****************************************
            * Comeca jogadores de fora
            ******************************************** */

            while ($row_game_mat_play_form_fora = $stmt_game_mat_play_form_fora->fetch(PDO::FETCH_ASSOC)) {
                if($row_game_mat_play_form_fora['type_match_result'] == 'fora'){
                    if($row_game_mat_play_form_fora['initial_eleven'] == true){
                        if($row_game_mat_play_form_fora['formation_away'] == '4-1-3-2'){
                           
                           
                            $html .= '
                                    <div class="row">';
                                        
                            if($row_game_mat_play_form_fora['position'] == 'GK'){ 
                                $html .= ' 
                                            <div class="col-sm" id="col_play_fora">
                                                <span id="gk_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_h'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }  
                            
                            if($row_game_mat_play_form_fora['position'] == 'DD'){ 
                                $html .= ' <div class="col-sm"id="col_play_fora">
                                                <span id="dd_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_fora['position'] == 'DCD'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="dcd_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }
                            if($row_game_mat_play_form_fora['position'] == 'DCE'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="dce_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }
                            if($row_game_mat_play_form_fora['position'] == 'DE'){ 
                                $html .= ' <div class="col-sm"id="col_play_fora">
                                                <span id="de_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }  
                            if($row_game_mat_play_form_fora['position'] == 'MDC'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="mdc_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_fora['position'] == 'MCD'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                            <span id="mdc_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_fora['position'] == 'MC'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="mc_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            } 
                            if($row_game_mat_play_form_fora['position'] == 'MCE'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="mce_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }
                            if($row_game_mat_play_form_fora['position'] == 'FWR'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="fwr_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }  
                            if($row_game_mat_play_form_fora['position'] == 'FWE'){ 
                                $html .= ' <div class="col-sm" id="col_play_fora">
                                                <span id="fwe_fora_4132"><img src="./logotipos/clubes/'.$row_game_mat_play_form_fora['logo_kit_away'].'" id="photo_player_jogo"/></span>
                                            </div>';
                            }        
                        $html .= '</div>';    
                        }
                    }
                }
            }
            $html .='</div>
                        </div>';   
        }else{  $html .= '';}
           
           
        

       

 
            
       
                        
                                   
         $html .= '                
                        </div>
                        <div id="classificacao" class="container tab-pane fade"><br>
                            cla

                        </div>
                        <div id="confrontros" class="container tab-pane fade"><br>

                            confr
                        </div>
                    </div>
                </div>
            </div>';
    }
        
}else{
    $html .= '
    <div class="container">
        <div class="row">
            <div class="col-sm">&nbsp</div>
            <div class="col-sm">
                <img src="./logotipos/icons/bola1.png" width="150px" height="150px"><br/>
                <span id="no_event_text">Não existe registos deste jogo</span>
            </div>
            <div class="col-sm">&nbsp</div>
        </div>
    </div>';
}
 $html .= '
    </div>';

echo $html;