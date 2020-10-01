<?php
if(count(get_included_files()) ==1){ exit("Direct access not permitted."); }

if(!isset($_SESSION['uid'])){
    session_destroy();
    $html ='
        <div class="container">
            <div class="container clearfix">
                <div class="col-md-12 text-center">
                    <img src="./logotipos/icons/no_favoritos.png" id="no_event"/><br/><br/>
                    <span id="no_event_text">
                        <h5> Precisa de iniciar a sessão para aceder aos seus favoritos.</h5>
                    </span>
                </div>
            </div>
        </div>';
    
}else{

    //Carregar Classe
    require_once './objects/Favorites_Teams.php';
    require_once './objects/Favorites_Players.php';
    require_once './objects/Favorites_Managers.php';
    require_once './objects/Favorites_Competitions.php';

    // Criar objeto da Classe
    $fav_teams = new Favorites_Teams($pdo);
    $fav_players = new Favorites_Players($pdo);
    $fav_managers = new Favorites_Managers($pdo);
    $fav_competitions = new Favorites_Competitions($pdo);

    //funcao
    require_once './common/funcoes/funcoes.php';

    $html = '
        <div class="container"><br><br>
            <div class="row" id="utilizador_fav">
                <div class="col-sm-4" id="div_hori"><br>
                    <a href="?m=perfil&a=utilizador" id="utilizador_fav_perfil">
                        <img src="./logotipos/icons/'.$_SESSION['photo_user'].'"id="photo_user_fav">
                        <span>'.$_SESSION['username'].'</span>
                    </a>
                </div>
                <div class="col-sm-4" id="elemina_fav"><br>
                    <button id="button_elimina_fav">
                        <img src="./logotipos/icons/eliminar.png">
                        <span>Eliminar eventos</span>
                    </button>
                </div>
                <div class="col-sm-4" id="btn_logout"><br>
                    <button id="button_logout"><a href="logout.php" id="button_logout">Encerrar Sessão</a></button>
                </div><br>
                <div class="col-sm-4" id="btn_logout"><br></div>
            </div><br>
            <div class="row" id="favs_titulo">
                    <div class="col-sm" id="titulo_favs">Jogadores</div>
                    <div class="col-sm" id="titulo_favs">Treinadores</div>
                    <div class="col-sm" id="titulo_favs">Equipas</div>
                    <div class="col-sm" id="titulo_favs">Competições</div>
            </div><br>
            <div class="row">
                    <div class="col-sm">';


    // Obter Produtos e numero de registos
    $stmt_team = $fav_teams->search($_SESSION['uid']);
    $stmt_player = $fav_players->search($_SESSION['uid']);
    $stmt_manager = $fav_managers->search($_SESSION['uid']);
    $stmt_competition = $fav_competitions->search($_SESSION['uid']);

    $num_team = $stmt_team->rowCount();
    $num_player = $stmt_player->rowCount();
    $num_manager = $stmt_manager->rowCount();
    $num_competitition = $stmt_competition->rowCount();

    if (($num_team > 0)||($num_player > 0)||($num_manager > 0)||($num_competitition > 0)) {
        // Apresentar conteudos
        while ($row_player = $stmt_player->fetch(PDO::FETCH_ASSOC)) {
            if($row_player['nickname_team'] === null){
                $html .= '
                    <div class="row" id="todos_fav_add">
                        <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                            <img src="./logotipos/jogadores/'.$row_player['photo_player'].'" id="photo_player_fav">
                        </a>
                        <div class="col-sm" id="fav_col">
                            <div class="row"> 
                                <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                                    '.$row_player['nickname_player'].'
                                </a>
                                <a href="?m='.$module.'&namep='.sanitizeString($row_player['name_country']).'&a=eliminar-jogador&nameplay='.sanitizeString($row_player['nickname_player']).'&idfav='.$row_player['id'].'" id="a_play">
                                    <button id="btn_seguindo">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>
                            </div><br>
                                <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                                    '.$row_player['name_country'].'
                                <img src="./logotipos/paises/'.$row_player['flag_country'].'" id="logo_flag_fav_pais">
                            </a>
                        </div>
                    </div>';
            }else{
                $html .= '
                    <div class="row" id="todos_fav_add">
                        <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                            <img src="./logotipos/jogadores/'.$row_player['photo_player'].'" id="photo_player_fav">
                        </a>
                        <div class="col-sm" id="fav_col">
                            <div class="row">
                                <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                                    '.$row_player['nickname_player'].'
                                    <p>
                                        <img src="./logotipos/clubes/'.$row_player['logo_team'].'" id="logo_team_fav_team">
                                        '.$row_player['nickname_team'].'
                                    </p>
                                </a>
                                <a href="?m='.$module.'&namep='.sanitizeString($row_player['name_country']).'&a=eliminar-jogador&nameplay='.sanitizeString($row_player['nickname_player']).'&idfav='.$row_player['id'].'" id="a_play">
                                    <button id="btn_seguindo2">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a>
                            </div><br>
                                <a href="?m=jogadores&'.sanitizeString($row_player['name_country']).'&a=jogador&'.sanitizeString($row_player['nickname_player']).'&id='.$row_player['idplayer'].'" id="a_fav">
                                    '.$row_player['name_country'].'
                                    <img src="./logotipos/paises/'.$row_player['flag_country'].'" id="logo_flag_fav_pais">
                                </a>
                        </div>
                    </div>';
            }
        }
        $html .= '
            </div>
            <div class="col-sm">';
       
        while ($row_manager = $stmt_manager->fetch(PDO::FETCH_ASSOC)) {
            if($row_manager['nickname_team'] === null){
                $html .= '
                    <div class="row" id="todos_fav_add">
                        <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                            <img src="./logotipos/treinadores/'.$row_manager['photo_manager'].'" id="photo_manager_fav">
                        </a>
                        <div class="col-sm" id="fav_col">
                            <div class="row"> 
                            <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                                '.$row_manager['nickname_manager'].'</span><br>
                            </a> 
                            <a href="?m='.$module.'&namep='.sanitizeString($row_manager['name_country']).'&a=eliminar-treinador&nameman='.sanitizeString($row_manager['nickname_manager']).'&idfav='.$row_manager['id'].'" id="a_play">
                                    <button id="btn_seguindo">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                            </a>  
                        </div><br>
                            <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                                '.$row_manager['name_country'].'
                                <img src="./logotipos/paises/'.$row_manager['flag_country'].'" id="logo_flag_fav_pais">
                            </a>
                        </div>
                    </div> ';
            }else{
                $html .= '
                    <div class="row" id="todos_fav_add">
                        <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                            <img src="./logotipos/treinadores/'.$row_manager['photo_manager'].'" id="photo_manager_fav">
                        </a>
                        <div class="col-sm" id="fav_col">
                            <div class="row"> 
                                <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                                    '.$row_manager['nickname_manager'].'</span><br>
                                    <p>
                                        '.$row_manager['nickname_team'].' 
                                        <img src="./logotipos/clubes/'.$row_manager['logo_team'].'" id="logo_team_fav_team">
                                    </p>
                                </a>
                                <a href="?m='.$module.'&namep='.sanitizeString($row_manager['name_country']).'&a=eliminar-treinador&nameman='.sanitizeString($row_manager['nickname_manager']).'&idfav='.$row_manager['id'].'" id="a_play">
                                    <button id="btn_seguindo">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                                </a> 
                            </div><br>
                                <a href="?m=treinadores&'.sanitizeString($row_manager['name_country']).'&a=treinador&'.sanitizeString($row_manager['nickname_manager']).'&id='.$row_manager['idmanager'].'"id="a_fav">
                                    '.$row_manager['name_country'].'
                                    <img src="./logotipos/paises/'.$row_manager['flag_country'].'" id="logo_flag_fav_pais">
                                </a>
                            </div>
                        </div> ';
            }
        }
        $html .='
            </div>
            <div class="col-sm">';

        while ($row_team = $stmt_team->fetch(PDO::FETCH_ASSOC)) {
            if($row_team['nickname_team'] === $row_team['country_name']){
                $html .= '
                    <div class="row" id="todos_fav_add">
                        <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa-internacional&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                            <img src="./logotipos/clubes/'.$row_team['logo_team'].'" id="logo_team_fav">
                        </a>
                            <div class="col-sm" id="fav_col">
                                <div class="row">
                                    <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa-internacional&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                                        '.$row_team['nickname_team'].'
                                    </a>
                                    <a href="?m='.$module.'&namep='.sanitizeString($row_team['name_country']).'&a=eliminar-equipa&nameequi='.sanitizeString($row_team['nickname_team']).'&idfav_fav='.$row_team['id'].'" id="a_play">
                                        <button id="btn_seguindo">Seguindo
                                            <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                        </button>
                                    </a> 
                                </div><br>
                                    <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa-internacional&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                                        '.$row_team['country_name'].'
                                        <img src="./logotipos/paises/'.$row_team['flag_country'].'" id="logo_flag_fav_pais">
                                    </a>
                            </div>
                        </div>';
            }else{
                $html .= '
                <div class="row" id="todos_fav_add">
                    <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                        <img src="./logotipos/clubes/'.$row_team['logo_team'].'" id="logo_team_fav">
                    </a>
                    <div class="col-sm" id="fav_col">
                        <div class="row"> 
                            <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                                '.$row_team['nickname_team'].'
                            </a>
                            <a href="?m='.$module.'&namep='.sanitizeString($row_team['name_country']).'&a=eliminar-equipa&nameequi='.sanitizeString($row_team['nickname_team']).'&idfav_fav='.$row_team['id'].'" id="a_play">
                                    <button id="btn_seguindo">Seguindo
                                        <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                                    </button>
                            </a> 
                        </div><br>
                        <a href="?m=equipas&'.sanitizeString($row_team['country_name']).'&a=equipa&'.sanitizeString($row_team['nickname_team']).'&id='.$row_team['idteam'].'"id="a_fav">
                            '.$row_team['country_name'].'
                            <img src="./logotipos/paises/'.$row_team['flag_country'].'" id="logo_flag_fav_pais">
                        </a>
                    </div>
                </div>';
            }
        }
        $html .='
            </div>
            <div class="col-sm">';
        
        while ($row_competition = $stmt_competition->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                <div class="row" id="todos_fav_add">
                    <a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name_competition']).'&id='.$row_competition['idcompetition'].'"id="a_fav">
                        <img src="./logotipos/competicoes/'.$row_competition['logo_competition'].'" id="logo_comp_fav_competicao">
                    </a>
                   <div class="col-sm" id="fav_col">   
                        <div class="row">   
                        <a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name_competition']).'&id='.$row_competition['idcompetition'].'"id="a_fav">
                            '.$row_competition['name_competition'].'
                        </a>
                        <a href="?m='.$module.'&a=eliminar-competicao&idfav='.$row_competition['id'].'" id="a_play">
                            <button id="btn_seguindo">Seguindo
                                <img src="./logotipos/icons/seguir.png" id="seguir_alert">
                            </button>
                        </a> 
                    </div><br>
                        <a href="?m=competicoes&'.sanitizeString($row_competition['name_country']).'&'.sanitizeString($row_competition['competition_type']).'&a=torneio&'.sanitizeString($row_competition['name_competition']).'&id='.$row_competition['idcompetition'].'"id="a_fav">
                            '.$row_competition['name_country'].'
                            <img src="./logotipos/paises/'.$row_competition['flag_country'].'" id="logo_flag_fav_pais">
                        </a>
                    </div>
                </div>';
        }
        $html .='
                </div>
            </div><br>
            <div class="row" id="todos_fav_conteudo">
            </div>
        </div>';
    }else{
        $html .='        
        <div class="container clearfix">
            <div class="col-md-12 text-center">
                <span id="no_event_text"><br><br><p>Não adicionou nenhum Favoritos<p><br/>
                </span>
            </div>
        </div>';
    }
    
}
echo $html;