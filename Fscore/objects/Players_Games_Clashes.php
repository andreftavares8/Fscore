<?php

class Players_Games_Clashes {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "players_games_clashes";
    // Propriedades
    public $id;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $idteam_away;
    public $idplayer;
    public $type_game_clashe;
    public $initial_formation;
    public $alternate_formation;
    public $punished;
    public $accumulation;
    public $expulsion;
    public $injured;
    public $nickname_player;
    public $photo_player;
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
    public $doubt;
    public $name_country;
    public $flag_country;
   

    
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
                        play_game.id,play_game.idgame_clashe,play_game.idcompetition,play_game.idteam_home,
                        play_game.idteam_away, play_game.idplayer,play_game.type_game_clashe,play_game.initial_formation,
                        play_game.alternate_formation, play_game.punished, play_game.accumulation,play_game.expulsion,
                        play_game.injured,play_game.doubt,
                        play.nickname as nickname_player, play.photo_player
                    FROM
                        players_games_clashes as play_game
                        INNER JOIN players as play
                            ON play.id = play_game.idplayer
                        ORDER BY play_game.id DESC";
                
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
                idplayer=:idplayer, 
                idgame_clashe=:idgame_clashe, 
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                idteam_away=:idteam_away,
                idplayer=:idplayer,
                type_game_clashe=:type_game_clashe,
                initial_formation=:initial_formation,
                alternate_formation=:alternate_formation,
                punished=:punished,
                accumulation=:accumulation,
                expulsion=:expulsion,
                injured=:injured,
                doubt=:doubt";
                
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->type_game_clashe =filter_var($this->type_game_clashe, FILTER_SANITIZE_STRING);
        $this->initial_formation = filter_var($this->initial_formation, FILTER_SANITIZE_NUMBER_INT);
        $this->alternate_formation = filter_var($this->alternate_formation, FILTER_SANITIZE_NUMBER_INT);
        $this->punished = filter_var($this->punished, FILTER_SANITIZE_NUMBER_INT);
        $this->accumulation = filter_var($this->accumulation, FILTER_SANITIZE_NUMBER_INT);
        $this->expulsion = filter_var($this->expulsion, FILTER_SANITIZE_NUMBER_INT);
        $this->injured = filter_var($this->injured, FILTER_SANITIZE_NUMBER_INT);
        $this->doubt = filter_var($this->doubt, FILTER_SANITIZE_NUMBER_INT);
        
        
        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":type_game_clashe", $this->type_game_clashe);
        $stmt->bindValue(":initial_formation", $this->initial_formation);
        $stmt->bindValue(":alternate_formation", $this->alternate_formation);
        $stmt->bindValue(":punished", $this->punished);
        $stmt->bindValue(":accumulation", $this->accumulation);
        $stmt->bindValue(":expulsion", $this->expulsion);
        $stmt->bindValue(":injured", $this->injured);
        $stmt->bindValue(":doubt", $this->doubt);
     
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
                        play_game.id,play_game.idgame_clashe,play_game.idcompetition,play_game.idteam_home,
                        play_game.idteam_away, play_game.idplayer,play_game.type_game_clashe,play_game.initial_formation,
                        play_game.alternate_formation, play_game.punished, play_game.accumulation,play_game.expulsion,
                        play_game.injured,play_game.doubt,
                        play.nickname as nickname_player, play.photo_player
                    FROM
                        players_games_clashes as play_game
                        INNER JOIN players as play
                            ON play.id = play_game.idplayer
                    WHERE
                        play_game.id = :ID
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
        $this->idgame_clashe = $row['idgame_clashe'];
        $this->idcompetition = $row['idcompetition'];
        $this->idteam_home = $row['idteam_home'];
        $this->idteam_away = $row['idteam_away'];
        $this->idplayer = $row['idplayer'];
        $this->type_game_clashe = $row['type_game_clashe'];
        $this->initial_formation = $row['initial_formation'];
        $this->alternate_formation = $row['alternate_formation'];
        $this->punished = $row['punished'];
        $this->accumulation = $row['accumulation'];
        $this->expulsion = $row['expulsion'];
        $this->injured = $row['injured'];
        $this->nickname_player = $row['nickname_player'];
        $this->photo_player = $row['photo_player'];
        $this->doubt = $row['doubt'];
        $this->name_country = $row['name_country'];
        $this->flag_country = $row['flag_country'];

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
                idplayer=:idplayer, 
                idgame_clashe=:idgame_clashe, 
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                idteam_away=:idteam_away,
                idplayer=:idplayer,
                type_game_clashe=:type_game_clashe,
                initial_formation=:initial_formation,
                alternate_formation=:alternate_formation,
                punished=:punished,
                accumulation=:accumulation,
                expulsion=:expulsion,
                injured=:injured,
                doubt=:doubt
            WHERE
            id = :id";
            
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->type_game_clashe =filter_var($this->type_game_clashe, FILTER_SANITIZE_STRING);
        $this->initial_formation = filter_var($this->initial_formation, FILTER_SANITIZE_NUMBER_INT);
        $this->alternate_formation = filter_var($this->alternate_formation, FILTER_SANITIZE_NUMBER_INT);
        $this->punished = filter_var($this->punished, FILTER_SANITIZE_NUMBER_INT);
        $this->accumulation = filter_var($this->accumulation, FILTER_SANITIZE_NUMBER_INT);
        $this->expulsion = filter_var($this->expulsion, FILTER_SANITIZE_NUMBER_INT);
        $this->injured = filter_var($this->injured, FILTER_SANITIZE_NUMBER_INT);
        $this->doubt = filter_var($this->doubt, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        
        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":type_game_clashe", $this->type_game_clashe);
        $stmt->bindValue(":initial_formation", $this->initial_formation);
        $stmt->bindValue(":alternate_formation", $this->alternate_formation);
        $stmt->bindValue(":punished", $this->punished);
        $stmt->bindValue(":accumulation", $this->accumulation);
        $stmt->bindValue(":expulsion", $this->expulsion);
        $stmt->bindValue(":injured", $this->injured);
        $stmt->bindValue(":doubt", $this->doubt);
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
    /* pesquisar filtro e jogo especifico estatic de players*/
    function searchByGamesinGamePlayer($keywords_game,$keywords_type) {
        // Query SQL
        $query = "SELECT                    	
                        play_game.id,play_game.idgame_clashe,play_game.idcompetition,play_game.idteam_home,
                        play_game.idteam_away, play_game.idplayer,play_game.type_game_clashe,play_game.initial_formation,
                        play_game.alternate_formation, play_game.punished, play_game.accumulation,play_game.expulsion,
                        play_game.injured,play_game.doubt,
                        play.nickname as nickname_player, play.photo_player,
                        counP.name as name_country,counP.flag_country


                    FROM
                        " . $this->table_name ." as play_game
                    LEFT JOIN players as play
                        ON play.id = play_game.idplayer
                    LEFT JOIN countries as counP
                        ON counP.id = play.idcountry
                    WHERE
                        play_game.idgame_clashe LIKE ? AND play_game.type_game_clashe LIKE ?
                    ORDER BY play_game.idplayer DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_game = '%'.filter_var($keywords_game,FILTER_SANITIZE_NUMBER_INT).'%';
        $search_type = '%'.filter_var($keywords_type,FILTER_SANITIZE_STRING).'%';
        
        // Atribuir valores 
        $stmt->bindValue(1, $search_game);
        $stmt->bindValue(2, $search_type);
       
    
        // Executar query
        $stmt->execute();

        return $stmt;
    }

    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        play_game.id,play_game.idgame_clashe,play_game.idcompetition,play_game.idteam_home,
                        play_game.idteam_away, play_game.idplayer,play_game.type_game_clashe,play_game.initial_formation,
                        play_game.alternate_formation, play_game.punished, play_game.accumulation,play_game.expulsion,
                        play_game.injured,play_game.doubt,
                        play.nickname as nickname_player, play.photo_player,
                        play_match.type_match_result,play_match.position,play_match.number_shirt,play_match.initial_eleven,
                        play_match.goals_conceded,play_match.goals_scored,play_match.assist,play_match.yellow_card,
                        play_match.red_card,play_match.minutes_goals, play_match.minutes_assist,play_match.minutes_yellow,
                        play_match.minutes_red,play_match.subs_entry,play_match.subs_out,play_match.rating_perfomance,
                        play_match.player_of_match
                    FROM
                        players_games_clashes as play_game
                        INNER JOIN players as play
                            ON play.id = play_game.idplayer
                        LEFT JOIN players_matchs_results as play_match
                            ON play_match.idplayer = play_game.idplayer
                        ORDER BY play_game.id DESC
                    WHERE
                        play_game.idgame_clashe LIKE ? 
                        ORDER BY play_game.id DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search);
        $stmt->bindValue(2, $search);
        $stmt->bindValue(3, $search);

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
                        play_game.id,play_game.idgame_clashe,play_game.idcompetition,play_game.idteam_home,
                        play_game.idteam_away, play_game.idplayer,play_game.type_game_clashe,play_game.initial_formation,
                        play_game.alternate_formation, play_game.punished, play_game.accumulation,play_game.expulsion,
                        play_game.injured,play_game.doubt,
                        play.nickname as nickname_player, play.photo_player
                    FROM
                        players_games_clashes as play_game
                        INNER JOIN players as play
                            ON play.id = play_game.idplayer
                        ORDER BY play_game.id DESC
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

