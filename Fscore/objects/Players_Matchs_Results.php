<?php

class Players_Matchs_Results {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "players_matchs_results";
    // Propriedades
    public $id;
    public $idmatch_result;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $idteam_away;
    public $idplayer;
    public $type_match_result;
    public $position;
    public $number_shirt;
    public $initial_eleven;
    public $goals_conceded;
    public $goals_scored;
    public $assist;
    public $yellow_card;
    public $red_card;
    public $minutes_goals;
    public $minutes_assist;
    public $minutes_yellow;
    public $minutes_red;
    public $subs_entry;
    public $subs_out;
    public $rating_perfomance;
    public $player_of_match;
    public $nickname_player;
    public $photo_player;
    public $date_game;
    public $home_nickname;
    public $home_logo_team;
    public $away_nickname;
    public $away_logo_team;
    public $scores_home;
    public $scores_away;
    public $logo_competition;
    public $name_comp;
    public $logo_kit_home;
    public $logo_kit_a;
    public $logo_kit_away;
    public $logo_kit_h;

    /**
     * Método construtor que instancia a ligação à Base de Dados
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Método para ler todos os elementos da tabela
     * @return PDOStatement Devolve PDOStatement com todos os elementos da tabela
     */
    function read() {

        // Query SQL
        $query = "SELECT 
                        play_match.id, play_match.idmatch_result,play_match.idgame_clashe,play_match.idcompetition,
                        play_match.idteam_home,play_match.idteam_away,play_match.idplayer,play_match.type_match_result,
                        play_match.position,play_match.number_shirt,play_match.initial_eleven,play_match.goals_conceded,
                        play_match.goals_scored,play_match.assist,play_match.yellow_card,play_match.red_card, 
                        play_match.minutes_goals, play_match.minutes_assist,play_match.minutes_yellow,play_match.minutes_red,
                        play_match.subs_entry,play_match.subs_out,play_match.rating_perfomance,play_match.player_of_match,
                        play.nickname as nickname_player, play.photo_player,
                        game.date_game,
                        team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,
                        team_away.nickname as away_nickname,team_away.logo_team as away_logo_team,
                        mat.scores_home,mat.scores_away,
                        comp.name as name_comp,comp.logo_competition
                    FROM
                        ". $this->table_name ." as play_match
                        INNER JOIN players as play
                            ON play.id = play_match.idplayer
                        INNER JOIN games_clashes as game
                            ON game.id = play_match.idgame_clashe
                        INNER JOIN teams as team_home
                            ON team_home.id = play_match.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = play_match.idteam_away
                        INNER JOIN matchs_results as mat
                            ON mat.id = play_match.idmatch_result
                        INNER JOIN competitions as comp
                            ON comp.id = play_match.idcompetition";
        
        // Preparar query statement
        $stmt = $this->conn->prepare($query);

        // Executar query
        $stmt->execute();

        // Devolver PDOStatement
        return $stmt;
        
    }

    /**
     * Método para criar registo na Base de Dados
     * @return Boolean Devolve true quando insere na Base de Dados
     */
    function create() {
        // Query de inserção
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                idmatch_result=:idmatch_result,
                idgame_clashe=:idgame_clashe, 
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                idteam_away=:idteam_away,
                idplayer=:idplayer, 
                type_match_result=:type_match_result,
                position=:position,
                number_shirt=:number_shirt,
                initial_eleven=:initial_eleven,
                goals_conceded=:goals_conceded,
                goals_scored=:goals_scored,
                assist=:assist,
                yellow_card=:yellow_card,
                red_card=:red_card,
                minutes_goals=:minutes_goals,
                minutes_assist=:minutes_assist,
                minutes_yellow=:minutes_yellow,
                minutes_red=:minutes_red,
                subs_entry=:subs_entry,
                subs_out=:subs_out,
                rating_perfomance=:rating_perfomance,
                player_of_match=:player_of_match";
             
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->type_match_result =filter_var($this->type_match_result, FILTER_SANITIZE_STRING);
        $this->position = filter_var($this->position, FILTER_SANITIZE_STRING);
        $this->number_shirt = filter_var($this->number_shirt, FILTER_SANITIZE_NUMBER_INT);
        $this->initial_eleven = filter_var($this->initial_eleven, FILTER_SANITIZE_NUMBER_INT);
        $this->goals_conceded = filter_var($this->goals_conceded, FILTER_SANITIZE_NUMBER_INT);
        $this->goals_scored = filter_var($this->goals_scored, FILTER_SANITIZE_NUMBER_INT);
        $this->assist = filter_var($this->assist, FILTER_SANITIZE_NUMBER_INT);
        $this->yellow_card = filter_var($this->yellow_card, FILTER_SANITIZE_NUMBER_INT);
        $this->red_card = (float)filter_var($this->red_card, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->minutes_goals = filter_var($this->minutes_goals, FILTER_SANITIZE_STRING);
        $this->minutes_assist = filter_var($this->minutes_assist, FILTER_SANITIZE_STRING);
        $this->minutes_yellow = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->minutes_red = filter_var($this->minutes_red, FILTER_SANITIZE_STRING);
        $this->subs_entry = filter_var($this->subs_entry, FILTER_SANITIZE_STRING);
        $this->subs_out = filter_var($this->subs_out, FILTER_SANITIZE_STRING);
        $this->rating_perfomance = (float)filter_var($this->red_card, FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION);
        $this->player_of_match = filter_var($this->player_of_match, FILTER_SANITIZE_NUMBER_INT);
        

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":type_match_result", $this->type_match_result);
        $stmt->bindValue(":position", $this->position);
        $stmt->bindValue(":number_shirt", $this->number_shirt);
        $stmt->bindValue(":initial_eleven", $this->initial_eleven);
        $stmt->bindValue(":goals_conceded", $this->goals_conceded);
        $stmt->bindValue(":goals_scored", $this->goals_scored);
        $stmt->bindValue(":assist", $this->assist);
        $stmt->bindValue(":yellow_card", $this->yellow_card);
        $stmt->bindValue(":red_card", $this->red_card);
        $stmt->bindValue(":minutes_goals", $this->minutes_goals);
        $stmt->bindValue(":minutes_assist", $this->minutes_assist);
        $stmt->bindValue(":minutes_yellow", $this->minutes_yellow);
        $stmt->bindValue(":minutes_red", $this->minutes_red);
        $stmt->bindValue(":subs_entry", $this->subs_entry);
        $stmt->bindValue(":subs_out", $this->subs_out);
        $stmt->bindValue(":rating_perfomance", $this->rating_perfomance);
        $stmt->bindValue(":player_of_match", $this->player_of_match);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para obter um registo da Base de Dados
     * @return None
     */
    function readOne() {
        // Query SQL para ler apenas um registo
        $query = "SELECT 
                    play_match.id, play_match.idmatch_result,play_match.idgame_clashe,play_match.idcompetition,
                    play_match.idteam_home,play_match.idteam_away,play_match.idplayer,play_match.type_match_result,
                    play_match.position,play_match.number_shirt,play_match.initial_eleven,play_match.goals_conceded,
                    play_match.goals_scored,play_match.assist,play_match.yellow_card,play_match.red_card, 
                    play_match.minutes_goals, play_match.minutes_assist,play_match.minutes_yellow,play_match.minutes_red,
                    play_match.subs_entry,play_match.subs_out,play_match.rating_perfomance,play_match.player_of_match,
                    play.nickname as nickname_player, play.photo_player
                FROM
                    ". $this->table_name ." as play_game
                    INNER JOIN players as play
                        ON play.id = play_match.idplayer
                    WHERE
                    play_match.id = :ID
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // Filtrar e associar valor do ID
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $stmt->bindValue(':ID', $this->id);

        // Executar query
        $stmt->execute();

        // Obter dados do registo e instanciar o objeto
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->idmatch_result = $row['idmatch_result'];
        $this->idgame_clashe = $row['idgame_clashe'];
        $this->idcompetition = $row['idcompetition'];
        $this->idteam_home = $row['idteam_home'];
        $this->idteam_away = $row['idteam_away'];
        $this->idmatch_result = $row['idmatch_result'];
        $this->idplayer = $row['idplayer'];
        $this->type_match_result = $row['type_match_result'];
        $this->position = $row['position'];
        $this->number_shirt = $row['number_shirt'];
        $this->initial_eleven = $row['initial_eleven'];
        $this->goals_conceded = $row['goals_conceded'];
        $this->goals_scored = $row['goals_scored'];
        $this->assist = $row['assist'];
        $this->yellow_card = $row['yellow_card'];
        $this->red_card = $row['red_card'];
        $this->minutes_goals = $row['minutes_goals'];
        $this->minutes_assist = $row['minutes_assist'];
        $this->minutes_yellow = $row['minutes_yellow'];
        $this->minutes_red = $row['minutes_red'];
        $this->subs_entry = $row['subs_entry'];
        $this->subs_out = $row['subs_out'];
        $this->rating_perfomance = $row['rating_perfomance'];
        $this->player_of_match = $row['player_of_match'];
        $this->nickname_player = $row['nickname_player'];
        $this->photo_player = $row['photo_player'];
        
    }

    /**
     * Método para atualizar um registo na Base de Dados
     * @return Boolean Devolve true quando atualiza na Base de Dados
     */
    function update() {

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                idmatch_result=:idmatch_result,
                idgame_clashe=:idgame_clashe, 
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                idteam_away=:idteam_away,
                idplayer=:idplayer, 
                type_match_result=:type_match_result,
                position=:position,
                number_shirt=:number_shirt,
                initial_eleven=:initial_eleven,
                goals_conceded=:goals_conceded,
                goals_scored=:goals_scored,
                assist=:assist,
                yellow_card=:yellow_card,
                red_card=:red_card,
                minutes_goals=:minutes_goals,
                minutes_assist=:minutes_assist,
                minutes_yellow=:minutes_yellow,
                minutes_red=:minutes_red,
                subs_entry=:subs_entry,
                subs_out=:subs_out,
                rating_perfomance=:rating_perfomance,
                player_of_match=:player_of_match
            WHERE
            id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->type_match_result =filter_var($this->type_match_result, FILTER_SANITIZE_STRING);
        $this->position = filter_var($this->position, FILTER_SANITIZE_STRING);
        $this->number_shirt = filter_var($this->number_shirt, FILTER_SANITIZE_NUMBER_INT);
        $this->initial_eleven = filter_var($this->initial_eleven, FILTER_SANITIZE_NUMBER_INT);
        $this->goals_conceded = filter_var($this->goals_conceded, FILTER_SANITIZE_NUMBER_INT);
        $this->goals_scored = filter_var($this->goals_scored, FILTER_SANITIZE_NUMBER_INT);
        $this->assist = filter_var($this->assist, FILTER_SANITIZE_NUMBER_INT);
        $this->yellow_card = filter_var($this->yellow_card, FILTER_SANITIZE_NUMBER_INT);
        $this->red_card = (float)filter_var($this->red_card, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->minutes_goals = filter_var($this->minutes_goals, FILTER_SANITIZE_STRING);
        $this->minutes_assist = filter_var($this->minutes_assist, FILTER_SANITIZE_STRING);
        $this->minutes_yellow = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->minutes_red = filter_var($this->minutes_red, FILTER_SANITIZE_STRING);
        $this->subs_entry = filter_var($this->subs_entry, FILTER_SANITIZE_STRING);
        $this->subs_out = filter_var($this->subs_out, FILTER_SANITIZE_STRING);
        $this->rating_perfomance = (float)filter_var($this->red_card, FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION);
        $this->player_of_match = filter_var($this->player_of_match, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":type_match_result", $this->type_match_result);
        $stmt->bindValue(":position", $this->position);
        $stmt->bindValue(":number_shirt", $this->number_shirt);
        $stmt->bindValue(":initial_eleven", $this->initial_eleven);
        $stmt->bindValue(":goals_conceded", $this->goals_conceded);
        $stmt->bindValue(":goals_scored", $this->goals_scored);
        $stmt->bindValue(":assist", $this->assist);
        $stmt->bindValue(":yellow_card", $this->yellow_card);
        $stmt->bindValue(":red_card", $this->red_card);
        $stmt->bindValue(":minutes_goals", $this->minutes_goals);
        $stmt->bindValue(":minutes_assist", $this->minutes_assist);
        $stmt->bindValue(":minutes_yellow", $this->minutes_yellow);
        $stmt->bindValue(":minutes_red", $this->minutes_red);
        $stmt->bindValue(":subs_entry", $this->subs_entry);
        $stmt->bindValue(":subs_out", $this->subs_out);
        $stmt->bindValue(":rating_perfomance", $this->rating_perfomance);
        $stmt->bindValue(":player_of_match", $this->player_of_match);
        $stmt->bindValue(":id", $this->id);


        // Executar query
//        var_dump($stmt);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para apagar um registo da Base de Dados
     * @return Boolean Devolve true quando remove da Base de Dados
     */
    function delete() {
        // Query SQL
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :ID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // Filtrar e associar valor do ID
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $stmt->bindValue(':ID', $this->id);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para pesquisa
     * @param string $keywords Palavras para procura
     * @return PDOStatement com resultado da procura
     */
    function search($keywords) {
        // Query SQL
        $query = "SELECT 
                        play_match.id, play_match.idmatch_result,play_match.idgame_clashe,play_match.idcompetition,
                        play_match.idteam_home,play_match.idteam_away,play_match.idplayer,play_match.type_match_result,
                        play_match.position,play_match.number_shirt,play_match.initial_eleven,play_match.goals_conceded,
                        play_match.goals_scored,play_match.assist,play_match.yellow_card,play_match.red_card, 
                        play_match.minutes_goals, play_match.minutes_assist,play_match.minutes_yellow,play_match.minutes_red,
                        play_match.subs_entry,play_match.subs_out,play_match.rating_perfomance,play_match.player_of_match,
                        play.nickname as nickname_player, play.photo_player,
                        game.date_game,
                        team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,team_home.logo_kit_home,team_home.logo_kit_away as logo_kit_a, 
                        team_away.nickname as away_nickname,team_away.logo_team as away_logo_team,team_away.logo_kit_away,team_away.logo_kit_home as logo_kit_h,
                        mat.scores_home,mat.scores_away,mat.formation_away, mat.formation_home,
                        comp.name as name_comp,comp.logo_competition
                        FROM
                        players_matchs_results as play_match
                        LEFT JOIN players as play
                            ON play.id = play_match.idplayer
                        LEFT JOIN games_clashes as game
                            ON game.id = play_match.idgame_clashe
                        LEFT JOIN teams as team_home
                            ON team_home.id = play_match.idteam_home
                        LEFT JOIN teams as team_away
                            ON team_away.id = play_match.idteam_away
                        LEFT JOIN matchs_results as mat
                            ON mat.id = play_match.idmatch_result
                        LEFT JOIN competitions as comp
                            ON comp.id = play_match.idcompetition
                        WHERE
                        play_match.idgame_clashe = ?";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = filter_var($keywords,FILTER_SANITIZE_NUMBER_INT);

        // Atribuir valores 
       $stmt->bindValue(1,$search);

        // Executar query
        $stmt->execute();
        return $stmt;
    }

    /**
     * Método para obter os registos de uma página
     * @param int $from_record_num - número do primeiro registo
     * @param int $records_per_page - número de registos por página
     * @return PDOStatement com registos da página
     */
    public function readPaging($from_record_num = 1, $records_per_page = 10) {

        // Query SQL
        $query = "SELECT 
                        play_match.id, play_match.idmatch_result,play_match.idgame_clashe,play_match.idcompetition,
                        play_match.idteam_home,play_match.idteam_away,play_match.idplayer,play_match.type_match_result,
                        play_match.position,play_match.number_shirt,play_match.initial_eleven,play_match.goals_conceded,
                        play_match.goals_scored,play_match.assist,play_match.yellow_card,play_match.red_card, 
                        play_match.minutes_goals, play_match.minutes_assist,play_match.minutes_yellow,play_match.minutes_red,
                        play_match.subs_entry,play_match.subs_out,play_match.rating_perfomance,play_match.player_of_match,
                        play.nickname as nickname_player, play.photo_player
                    FROM
                        ". $this->table_name ." as play_game
                        INNER JOIN players as play
                            ON play.id = play_match.idplayer
                    ORDER BY play_match.id DESC
                    LIMIT :FIRST_REC, :NUM_REC";

        // Preparar Query
        $stmt = $this->conn->prepare($query);

        // Atribuir valores
        $stmt->bindValue(':FIRST_REC', $from_record_num, PDO::PARAM_INT);
        $stmt->bindValue(':NUM_REC', $records_per_page, PDO::PARAM_INT);

        // Executar query
        $stmt->execute();

        // Devolver resultados
        return $stmt;
    }

    /**
     * Método para devolver o número total de registos
     * @return int
     */
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
    
}

