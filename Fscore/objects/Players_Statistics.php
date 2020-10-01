<?php

class Players_Statistics {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "players_statistics";
    // Propriedades
    
    public $id;
    public $idmatch_result;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $idteam_away;
    public $idplayer;
    public $position;
    public $minutes_played;
    public $defenses;
    public $punches;
    public $exits;
    public $successful_exits;
    public $claimed_ai_balls;
    public $defenses_in_box;
    public $capital_errors;
    public $touches_ball;
    public $passes_right;
    public $passes_right_percentage;
    public $crossings;
    public $precise_crossings;
    public $long_balls;
    public $precise_long_balls;
    public $cut_balls;
    public $shots_saved;
    public $interceptions;
    public $tackles;
    public $dribbling_suffered;
    public $floor_duels;
    public $won_floor_duels;
    public $air_duels;
    public $won_air_duels;
    public $loss_of_possession;
    public $fouls_committed;
    public $fouls_suffered;
    public $shots_total;
    public $shots_inside_box;
    public $shots_outside_box;
    public $goal_strikes;
    public $goal_strikes_out;
    public $shots_blocked;
    public $dribbling_attempts;
    public $successful_dribbling_attempts;
    public $offside;
    public $nickname_player;
    public $photo_player;
    public $home_nickname_team;
    public $logo_team_home;
    public $away_nickname_team;
    public $logo_team_away;
    public $type_match_result;
    public $goals_conceded;
    public $goals_scored;
    public $assist;
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
                        play_stati.id,play_stati.idmatch_result, play_stati.idgame_clashe,play_stati.idcompetition,play_stati.idteam_home,
                        play_stati.idteam_away,play_stati.idplayer,play_stati.position,play_stati.minutes_played,play_stati.defenses,
                        play_stati.punches,play_stati.exits,play_stati.successful_exits,play_stati.claimed_ai_balls,play_stati.defenses_in_box,
                        play_stati.capital_errors,play_stati.touches_ball,play_stati.passes_right,play_stati.passes_right_percentage,
                        play_stati.crossings,play_stati.precise_crossings,play_stati.long_balls,play_stati.precise_long_balls,play_stati.cut_balls,
                        play_stati.shots_saved,play_stati.interceptions,play_stati.tackles,play_stati.dribbling_suffered,
                        play_stati.floor_duels,play_stati.won_floor_duels,play_stati.air_duels,play_stati.won_air_duels,play_stati.loss_of_possession,
                        play_stati.fouls_committed,play_stati.fouls_suffered,play_stati.shots_total,play_stati.shots_inside_box,play_stati.shots_outside_box,
                        play_stati.goal_strikes,play_stati.goal_strikes_out,play_stati.shots_blocked,play_stati.dribbling_attempts,play_stati.successful_dribbling_attempts,
                        play_stati.offside,
                        play.nickname as nickname_player, play.photo_player,
                        team_home.nickname as home_nickname_team, team_home.logo_team as logo_team_home,
                        team_away.nickname as away_nickname_team, team_home.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as play_stati
                        INNER JOIN players as play
                            ON play.id = play_stati.idplayer
                        INNER JOIN teams as team_home
                            ON team_home.id = play_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = play_stati.idteam_away
                    ORDER BY play_stati.id DESC";
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
                position=:position,
                minutes_played=:minutes_played, 
                defenses=:defenses,
                punches=:punches, 
                exits=:exits,
                successful_exits=:successful_exits,
                claimed_ai_balls=:claimed_ai_balls, 
                defenses_in_box=:defenses_in_box,
                capital_errors=:capital_errors, 
                touches_ball=:touches_ball,
                passes_right=:passes_right, 
                passes_right_percentage=:passes_right_percentage,
                crossings=:crossings, 
                precise_crossings=:precise_crossings,
                long_balls=:long_balls,
                precise_long_balls=:precise_long_balls, 
                cut_balls=:cut_balls,
                shots_saved=:shots_saved,
                interceptions=:interceptions, 
                tackles=:tackles,
                dribbling_suffered=:dribbling_suffered,
                floor_duels=:floor_duels,
                won_floor_duels=:won_floor_duels, 
                air_duels=:air_duels,
                won_air_duels=:won_air_duels, 
                loss_of_possession=:loss_of_possession,
                fouls_committed=:fouls_committed, 
                fouls_suffered=:fouls_suffered,
                shots_total=:shots_total,
                shots_inside_box=:shots_inside_box, 
                shots_outside_box=:shots_outside_box,
                goal_strikes=:goal_strikes,
                goal_strikes_out=:goal_strikes_out, 
                shots_blocked=:shots_blocked,
                dribbling_attempts=:dribbling_attempts,
                successful_dribbling_attempts=:successful_dribbling_attempts, 
                offside=:offside";
                  
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->position =filter_var($this->position, FILTER_SANITIZE_STRING);
        $this->minutes_played = filter_var($this->minutes_played, FILTER_SANITIZE_NUMBER_INT);
        $this->defenses = filter_var($this->defenses, FILTER_SANITIZE_NUMBER_INT);
        $this->punches = filter_var($this->punches, FILTER_SANITIZE_NUMBER_INT);
        $this->exits = filter_var($this->exits, FILTER_SANITIZE_NUMBER_INT);
        $this->successful_exits = filter_var($this->successful_exits, FILTER_SANITIZE_NUMBER_INT);
        $this->claimed_ai_balls = filter_var($this->claimed_ai_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->defenses_in_box =filter_var($this->defenses_in_box, FILTER_SANITIZE_NUMBER_INT);
        $this->capital_errors =filter_var($this->capital_errors, FILTER_SANITIZE_NUMBER_INT);
        $this->touches_ball = filter_var($this->touches_ball, FILTER_SANITIZE_NUMBER_INT);
        $this->passes_right = filter_var($this->passes_right, FILTER_SANITIZE_NUMBER_INT);
        $this->passes_right_percentage = filter_var($this->passes_right_percentage, FILTER_SANITIZE_NUMBER_INT);
        $this->crossings = filter_var($this->crossings, FILTER_SANITIZE_NUMBER_INT);
        $this->precise_crossings = filter_var($this->precise_crossings, FILTER_SANITIZE_NUMBER_INT);
        $this->long_balls = filter_var($this->long_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->precise_long_balls =filter_var($this->precise_long_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->cut_balls = filter_var($this->cut_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_saved = filter_var($this->shots_saved, FILTER_SANITIZE_NUMBER_INT);
        $this->interceptions = filter_var($this->interceptions, FILTER_SANITIZE_NUMBER_INT);
        $this->tackles = filter_var($this->tackles, FILTER_SANITIZE_NUMBER_INT);
        $this->dribbling_suffered = filter_var($this->dribbling_suffered, FILTER_SANITIZE_NUMBER_INT);
        $this->floor_duels = filter_var($this->floor_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->won_floor_duels =filter_var($this->won_floor_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->air_duels =filter_var($this->air_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->won_air_duels = filter_var($this->won_air_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->loss_of_possession = filter_var($this->loss_of_possession, FILTER_SANITIZE_NUMBER_INT);
        $this->fouls_committed = filter_var($this->fouls_committed, FILTER_SANITIZE_NUMBER_INT);
        $this->fouls_suffered = filter_var($this->fouls_suffered, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_total = filter_var($this->shots_total, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_inside_box = filter_var($this->shots_inside_box, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_outside_box =filter_var($this->shots_outside_box, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_strikes = filter_var($this->goal_strikes, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_strikes_out = filter_var($this->goal_strikes_out, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_blocked = filter_var($this->shots_blocked, FILTER_SANITIZE_NUMBER_INT);
        $this->dribbling_attempts = filter_var($this->dribbling_attempts, FILTER_SANITIZE_NUMBER_INT);
        $this->successful_dribbling_attempts = filter_var($this->successful_dribbling_attempts, FILTER_SANITIZE_NUMBER_INT);
        $this->offside = filter_var($this->offside, FILTER_SANITIZE_NUMBER_INT);   

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":position", $this->position);
        $stmt->bindValue(":minutes_played", $this->minutes_played);
        $stmt->bindValue(":defenses", $this->defenses);
        $stmt->bindValue(":punches", $this->punches);
        $stmt->bindValue(":exits", $this->exits);
        $stmt->bindValue(":successful_exits", $this->successful_exits);
        $stmt->bindValue(":claimed_ai_balls", $this->claimed_ai_balls);
        $stmt->bindValue(":defenses_in_box", $this->defenses_in_box);
        $stmt->bindValue(":capital_errors", $this->capital_errors);
        $stmt->bindValue(":touches_ball", $this->touches_ball);
        $stmt->bindValue(":passes_right", $this->passes_right);
        $stmt->bindValue(":passes_right_percentage", $this->passes_right_percentage);
        $stmt->bindValue(":crossings", $this->crossings);
        $stmt->bindValue(":precise_crossings", $this->precise_crossings);
        $stmt->bindValue(":long_balls", $this->long_balls);
        $stmt->bindValue(":precise_long_balls", $this->precise_long_balls);
        $stmt->bindValue(":cut_balls", $this->cut_balls);
        $stmt->bindValue(":shots_saved", $this->shots_saved);
        $stmt->bindValue(":interceptions", $this->interceptions);
        $stmt->bindValue(":tackles", $this->tackles);
        $stmt->bindValue(":dribbling_suffered", $this->dribbling_suffered);
        $stmt->bindValue(":floor_duels", $this->floor_duels);
        $stmt->bindValue(":won_floor_duels", $this->won_floor_duels);
        $stmt->bindValue(":air_duels", $this->air_duels);
        $stmt->bindValue(":won_air_duels", $this->won_air_duels);
        $stmt->bindValue(":loss_of_possession", $this->loss_of_possession);
        $stmt->bindValue(":fouls_committed", $this->fouls_committed);
        $stmt->bindValue(":fouls_suffered", $this->fouls_suffered);
        $stmt->bindValue(":shots_total", $this->shots_total);
        $stmt->bindValue(":shots_inside_box", $this->shots_inside_box);
        $stmt->bindValue(":shots_outside_box", $this->shots_outside_box);
        $stmt->bindValue(":goal_strikes", $this->goal_strikes);
        $stmt->bindValue(":goal_strikes_out", $this->goal_strikes_out);
        $stmt->bindValue(":shots_blocked", $this->shots_blocked);
        $stmt->bindValue(":dribbling_attempts", $this->dribbling_attempts);
        $stmt->bindValue(":successful_dribbling_attempts", $this->successful_dribbling_attempts);
        $stmt->bindValue(":offside", $this->loss_of_possession);
        
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
                        play_stati.id,play_stati.idmatch_result, play_stati.idgame_clashe,play_stati.idcompetition,play_stati.idteam_home,
                        play_stati.idteam_away,play_stati.idplayer,play_stati.position,play_stati.minutes_played,play_stati.defenses,
                        play_stati.punches,play_stati.exits,play_stati.successful_exits,play_stati.claimed_ai_balls,play_stati.defenses_in_box,
                        play_stati.capital_errors,play_stati.touches_ball,play_stati.passes_right,play_stati.passes_right_percentage,
                        play_stati.crossings,play_stati.precise_crossings,play_stati.long_balls,play_stati.precise_long_balls,play_stati.cut_balls,
                        play_stati.shots_saved,play_stati.interceptions,play_stati.tackles,play_stati.dribbling_suffered,
                        play_stati.floor_duels,play_stati.won_floor_duels,play_stati.air_duels,play_stati.won_air_duels,play_stati.loss_of_possession,
                        play_stati.fouls_committed,play_stati.fouls_suffered,play_stati.shots_total,play_stati.shots_inside_box,play_stati.shots_outside_box,
                        play_stati.goal_strikes,play_stati.goal_strikes_out,play_stati.shots_blocked,play_stati.dribbling_attempts,play_stati.successful_dribbling_attempts,
                        play_stati.offside,
                        play.nickname as nickname_player, play.photo_player,
                        team_home.nickname as home_nickname_team, team_home.logo_team as logo_team_home,
                        team_away.nickname as away_nickname_team, team_home.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as play_stati
                        INNER JOIN players as play
                            ON play.id = play_stati.idplayer
                        INNER JOIN teams as team_home
                            ON team_home.id = play_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = play_stati.idteam_away
                    WHERE
                        play_stati.id = :ID
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
        $this->idplayer = $row['idplayer'];
        $this->position = $row['position'];
        $this->minutes_played = $row['minutes_played'];
        $this->defenses = $row['defenses'];
        $this->punches = $row['punches'];
        $this->exits = $row['exits'];
        $this->successful_exits = $row['successful_exits'];
        $this->claimed_ai_balls = $row['claimed_ai_balls'];
        $this->defenses_in_box = $row['defenses_in_box'];
        $this->capital_errors = $row['capital_errors'];
        $this->touches_ball = $row['touches_ball'];
        $this->passes_right = $row['passes_right'];
        $this->passes_right_percentage = $row['passes_right_percentage'];
        $this->crossings = $row['crossings'];
        $this->precise_crossings = $row['precise_crossings'];
        $this->long_balls = $row['long_balls'];
        $this->precise_long_balls = $row['precise_long_balls'];
        $this->cut_balls = $row['cut_balls'];
        $this->shots_saved = $row['shots_saved'];
        $this->interceptions = $row['interceptions'];
        $this->tackles = $row['tackles'];
        $this->dribbling_suffered = $row['dribbling_suffered'];
        $this->floor_duels = $row['floor_duels'];
        $this->won_floor_duels = $row['won_floor_duels'];
        $this->air_duels = $row['air_duels'];
        $this->won_air_duels = $row['won_air_duels'];
        $this->loss_of_possession = $row['loss_of_possession'];
        $this->fouls_committed = $row['fouls_committed'];
        $this->fouls_suffered = $row['fouls_suffered'];
        $this->shots_total = $row['shots_total'];
        $this->shots_inside_box = $row['shots_inside_box'];
        $this->shots_outside_box = $row['shots_outside_box'];
        $this->goal_strikes = $row['goal_strikes'];
        $this->goal_strikes_out = $row['goal_strikes_out'];
        $this->shots_blocked = $row['shots_blocked'];
        $this->dribbling_attempts = $row['dribbling_attempts'];
        $this->successful_dribbling_attempts = $row['successful_dribbling_attempts'];
        $this->offside = $row['offside'];
        $this->nickname_player = $row['nickname_player'];
        $this->photo_player = $row['photo_player'];
        $this->home_nickname_team = $row['home_nickname_team'];
        $this->logo_team_home = $row['logo_team_home'];
        $this->away_nickname_team = $row['away_nickname_team'];
        $this->logo_team_away = $row['logo_team_away'];


        
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
                position=:position,
                minutes_played=:minutes_played, 
                defenses=:defenses,
                punches=:punches, 
                exits=:exits,
                successful_exits=:successful_exits,
                claimed_ai_balls=:claimed_ai_balls, 
                defenses_in_box=:defenses_in_box,
                capital_errors=:capital_errors, 
                touches_ball=:touches_ball,
                passes_right=:passes_right, 
                passes_right_percentage=:passes_right_percentage,
                crossings=:crossings, 
                precise_crossings=:precise_crossings,
                long_balls=:long_balls,
                precise_long_balls=:precise_long_balls, 
                cut_balls=:cut_balls,
                shots_saved=:shots_saved,
                interceptions=:interceptions, 
                tackles=:tackles,
                dribbling_suffered=:dribbling_suffered,
                floor_duels=:floor_duels,
                won_floor_duels=:won_floor_duels, 
                air_duels=:air_duels,
                won_air_duels=:won_air_duels, 
                loss_of_possession=:loss_of_possession,
                fouls_committed=:fouls_committed, 
                fouls_suffered=:fouls_suffered,
                shots_total=:shots_total,
                shots_inside_box=:shots_inside_box, 
                shots_outside_box=:shots_outside_box,
                goal_strikes=:goal_strikes,
                goal_strikes_out=:goal_strikes_out, 
                shots_blocked=:shots_blocked,
                dribbling_attempts=:dribbling_attempts,
                successful_dribbling_attempts=:successful_dribbling_attempts, 
                offside=:offside
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
        $this->position =filter_var($this->position, FILTER_SANITIZE_STRING);
        $this->minutes_played = filter_var($this->minutes_played, FILTER_SANITIZE_NUMBER_INT);
        $this->defenses = filter_var($this->defenses, FILTER_SANITIZE_NUMBER_INT);
        $this->punches = filter_var($this->punches, FILTER_SANITIZE_NUMBER_INT);
        $this->exits = filter_var($this->exits, FILTER_SANITIZE_NUMBER_INT);
        $this->successful_exits = filter_var($this->successful_exits, FILTER_SANITIZE_NUMBER_INT);
        $this->claimed_ai_balls = filter_var($this->claimed_ai_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->defenses_in_box =filter_var($this->defenses_in_box, FILTER_SANITIZE_NUMBER_INT);
        $this->capital_errors =filter_var($this->capital_errors, FILTER_SANITIZE_NUMBER_INT);
        $this->touches_ball = filter_var($this->touches_ball, FILTER_SANITIZE_NUMBER_INT);
        $this->passes_right = filter_var($this->passes_right, FILTER_SANITIZE_NUMBER_INT);
        $this->passes_right_percentage = filter_var($this->passes_right_percentage, FILTER_SANITIZE_NUMBER_INT);
        $this->crossings = filter_var($this->crossings, FILTER_SANITIZE_NUMBER_INT);
        $this->precise_crossings = filter_var($this->precise_crossings, FILTER_SANITIZE_NUMBER_INT);
        $this->long_balls = filter_var($this->long_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->precise_long_balls =filter_var($this->precise_long_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->cut_balls = filter_var($this->cut_balls, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_saved = filter_var($this->shots_saved, FILTER_SANITIZE_NUMBER_INT);
        $this->interceptions = filter_var($this->interceptions, FILTER_SANITIZE_NUMBER_INT);
        $this->tackles = filter_var($this->tackles, FILTER_SANITIZE_NUMBER_INT);
        $this->dribbling_suffered = filter_var($this->dribbling_suffered, FILTER_SANITIZE_NUMBER_INT);
        $this->floor_duels = filter_var($this->floor_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->won_floor_duels =filter_var($this->won_floor_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->air_duels =filter_var($this->air_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->won_air_duels = filter_var($this->won_air_duels, FILTER_SANITIZE_NUMBER_INT);
        $this->loss_of_possession = filter_var($this->loss_of_possession, FILTER_SANITIZE_NUMBER_INT);
        $this->fouls_committed = filter_var($this->fouls_committed, FILTER_SANITIZE_NUMBER_INT);
        $this->fouls_suffered = filter_var($this->fouls_suffered, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_total = filter_var($this->shots_total, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_inside_box = filter_var($this->shots_inside_box, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_outside_box =filter_var($this->shots_outside_box, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_strikes = filter_var($this->goal_strikes, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_strikes_out = filter_var($this->goal_strikes_out, FILTER_SANITIZE_NUMBER_INT);
        $this->shots_blocked = filter_var($this->shots_blocked, FILTER_SANITIZE_NUMBER_INT);
        $this->dribbling_attempts = filter_var($this->dribbling_attempts, FILTER_SANITIZE_NUMBER_INT);
        $this->successful_dribbling_attempts = filter_var($this->successful_dribbling_attempts, FILTER_SANITIZE_NUMBER_INT);
        $this->offside = filter_var($this->offside, FILTER_SANITIZE_NUMBER_INT);  
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);   
 

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":position", $this->position);
        $stmt->bindValue(":minutes_played", $this->minutes_played);
        $stmt->bindValue(":defenses", $this->defenses);
        $stmt->bindValue(":punches", $this->punches);
        $stmt->bindValue(":exits", $this->exits);
        $stmt->bindValue(":successful_exits", $this->successful_exits);
        $stmt->bindValue(":claimed_ai_balls", $this->claimed_ai_balls);
        $stmt->bindValue(":defenses_in_box", $this->defenses_in_box);
        $stmt->bindValue(":capital_errors", $this->capital_errors);
        $stmt->bindValue(":touches_ball", $this->touches_ball);
        $stmt->bindValue(":passes_right", $this->passes_right);
        $stmt->bindValue(":passes_right_percentage", $this->passes_right_percentage);
        $stmt->bindValue(":crossings", $this->crossings);
        $stmt->bindValue(":precise_crossings", $this->precise_crossings);
        $stmt->bindValue(":long_balls", $this->long_balls);
        $stmt->bindValue(":precise_long_balls", $this->precise_long_balls);
        $stmt->bindValue(":cut_balls", $this->cut_balls);
        $stmt->bindValue(":shots_saved", $this->shots_saved);
        $stmt->bindValue(":interceptions", $this->interceptions);
        $stmt->bindValue(":tackles", $this->tackles);
        $stmt->bindValue(":dribbling_suffered", $this->dribbling_suffered);
        $stmt->bindValue(":floor_duels", $this->floor_duels);
        $stmt->bindValue(":won_floor_duels", $this->won_floor_duels);
        $stmt->bindValue(":air_duels", $this->air_duels);
        $stmt->bindValue(":won_air_duels", $this->won_air_duels);
        $stmt->bindValue(":loss_of_possession", $this->loss_of_possession);
        $stmt->bindValue(":fouls_committed", $this->fouls_committed);
        $stmt->bindValue(":fouls_suffered", $this->fouls_suffered);
        $stmt->bindValue(":shots_total", $this->shots_total);
        $stmt->bindValue(":shots_inside_box", $this->shots_inside_box);
        $stmt->bindValue(":shots_outside_box", $this->shots_outside_box);
        $stmt->bindValue(":goal_strikes", $this->goal_strikes);
        $stmt->bindValue(":goal_strikes_out", $this->goal_strikes_out);
        $stmt->bindValue(":shots_blocked", $this->shots_blocked);
        $stmt->bindValue(":dribbling_attempts", $this->dribbling_attempts);
        $stmt->bindValue(":successful_dribbling_attempts", $this->successful_dribbling_attempts);
        $stmt->bindValue(":offside", $this->loss_of_possession);
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
    function searchByPlayerInGame($keywords_play,$keywords_game) {
        // Query SQL
        $query = "SELECT
                        play_stati.id,play_stati.idmatch_result, play_stati.idgame_clashe,play_stati.idcompetition,play_stati.idteam_home,
                        play_stati.idteam_away,play_stati.idplayer,play_stati.position,play_stati.minutes_played,play_stati.defenses,
                        play_stati.punches,play_stati.exits,play_stati.successful_exits,play_stati.claimed_ai_balls,play_stati.defenses_in_box,
                        play_stati.capital_errors,play_stati.touches_ball,play_stati.passes_right,play_stati.passes_right_percentage,
                        play_stati.crossings,play_stati.precise_crossings,play_stati.long_balls,play_stati.precise_long_balls,play_stati.cut_balls,
                        play_stati.shots_saved,play_stati.interceptions,play_stati.tackles,play_stati.dribbling_suffered,
                        play_stati.floor_duels,play_stati.won_floor_duels,play_stati.air_duels,play_stati.won_air_duels,play_stati.loss_of_possession,
                        play_stati.fouls_committed,play_stati.fouls_suffered,play_stati.shots_total,play_stati.shots_inside_box,play_stati.shots_outside_box,
                        play_stati.goal_strikes,play_stati.goal_strikes_out,play_stati.shots_blocked,play_stati.dribbling_attempts,play_stati.successful_dribbling_attempts,
                        play_stati.offside,
                        play.nickname as nickname_player, play.photo_player,
                        coun.name as name_country,
                        team_home.nickname as home_nickname_team, team_home.logo_team as logo_team_home,
                        team_away.nickname as away_nickname_team, team_away.logo_team as logo_team_away,
                        play_match.type_match_result,play_match.goals_conceded,play_match.goals_scored,play_match.assist
                        
                    FROM
                        ". $this->table_name. " as play_stati
                        LEFT JOIN players as play
                            ON play.id = play_stati.idplayer
                        LEFT JOIN teams as team_home
                            ON team_home.id = play_stati.idteam_home
                        LEFT JOIN teams as team_away
                            ON team_away.id = play_stati.idteam_away
                        LEFT JOIN players_matchs_results as play_match
                            ON play_match.id = play_stati.idmatch_result
                        LEFT JOIN countries as coun
                            ON coun.id = play.idcountry
                    WHERE
                        play_stati.idplayer = ? AND play_stati.idgame_clashe = ?
                        ORDER BY play_stati.id DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_play = filter_var($keywords_play,FILTER_SANITIZE_NUMBER_INT);
        $search_game = filter_var($keywords_game,FILTER_SANITIZE_NUMBER_INT);
        // Atribuir valores 
        $stmt->bindValue(1, $search_play);
        $stmt->bindValue(2, $search_game);

        // Executar query
        $stmt->execute();

        return $stmt;
    }

    function search($keywords) {
        // Query SQL
        $query = "SELECT
                        play_stati.id,play_stati.idmatch_result, play_stati.idgame_clashe,play_stati.idcompetition,play_stati.idteam_home,
                        play_stati.idteam_away,play_stati.idplayer,play_stati.position,play_stati.minutes_played,play_stati.defenses,
                        play_stati.punches,play_stati.exits,play_stati.successful_exits,play_stati.claimed_ai_balls,play_stati.defenses_in_box,
                        play_stati.capital_errors,play_stati.touches_ball,play_stati.passes_right,play_stati.passes_right_percentage,
                        play_stati.crossings,play_stati.precise_crossings,play_stati.long_balls,play_stati.precise_long_balls,play_stati.cut_balls,
                        play_stati.shots_saved,play_stati.interceptions,play_stati.tackles,play_stati.dribbling_suffered,
                        play_stati.floor_duels,play_stati.won_floor_duels,play_stati.air_duels,play_stati.won_air_duels,play_stati.loss_of_possession,
                        play_stati.fouls_committed,play_stati.fouls_suffered,play_stati.shots_total,play_stati.shots_inside_box,play_stati.shots_outside_box,
                        play_stati.goal_strikes,play_stati.goal_strikes_out,play_stati.shots_blocked,play_stati.dribbling_attempts,play_stati.successful_dribbling_attempts,
                        play_stati.offside,
                        play.nickname as nickname_player, play.photo_player,
                        team_home.nickname as home_nickname_team, team_home.logo_team as logo_team_home,
                        team_away.nickname as away_nickname_team, team_home.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as play_stati
                        INNER JOIN players as play
                            ON play.id = play_stati.idplayer
                        INNER JOIN teams as team_home
                            ON team_home.id = play_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = play_stati.idteam_away
                    WHERE
                        play_stati.id LIKE ? OR play_stati.idplayer LIKE ? OR  play_stati.idteam_home LIKE ?
                        OR play_stati.idteam_away LIKE ? OR play.id LIKE ?
                        ORDER BY play_stati.id DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search);
        $stmt->bindValue(2, $search);
        $stmt->bindValue(3, $search);
        $stmt->bindValue(4, $search);
        $stmt->bindValue(5, $search);

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
                        play_stati.id,play_stati.idmatch_result, play_stati.idgame_clashe,play_stati.idcompetition,play_stati.idteam_home,
                        play_stati.idteam_away,play_stati.idplayer,play_stati.position,play_stati.minutes_played,play_stati.defenses,
                        play_stati.punches,play_stati.exits,play_stati.successful_exits,play_stati.claimed_ai_balls,play_stati.defenses_in_box,
                        play_stati.capital_errors,play_stati.touches_ball,play_stati.passes_right,play_stati.passes_right_percentage,
                        play_stati.crossings,play_stati.precise_crossings,play_stati.long_balls,play_stati.precise_long_balls,play_stati.cut_balls,
                        play_stati.shots_saved,play_stati.interceptions,play_stati.tackles,play_stati.dribbling_suffered,
                        play_stati.floor_duels,play_stati.won_floor_duels,play_stati.air_duels,play_stati.won_air_duels,play_stati.loss_of_possession,
                        play_stati.fouls_committed,play_stati.fouls_suffered,play_stati.shots_total,play_stati.shots_inside_box,play_stati.shots_outside_box,
                        play_stati.goal_strikes,play_stati.goal_strikes_out,play_stati.shots_blocked,play_stati.dribbling_attempts,play_stati.successful_dribbling_attempts,
                        play_stati.offside,
                        play.nickname as nickname_player, play.photo_player,
                        team_home.nickname as home_nickname_team, team_home.logo_team as logo_team_home,
                        team_away.nickname as away_nickname_team, team_home.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as play_stati
                        INNER JOIN players as play
                            ON play.id = play_stati.idplayer
                        INNER JOIN teams as team_home
                            ON team_home.id = play_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = play_stati.idteam_away
                    ORDER BY play_stati.id DESC
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

