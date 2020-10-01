<?php
class Games_Clashes {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "games_clashes";
    // Propriedades
    public $id;
    public $idteam_home;
    public $idteam_away;
    public $idcompetition;
    public $number_journey;
    public $date_game;
    public $time_game;
    public $season;
    public $idstadium;
    public $home_nickname;
    public $home_logo_team;
    public $home_logo_kit;
    public $away_nickname;
    public $away_logo_team;
    public $away_logo_kit;
    public $name_competition;
    public $logo_competition;
    public $competition_type;
    public $logo_federation;
    public $idcountry;
    public $name_country;
    public $flag_country;
    public $name_stadium;
    public $logo_stadium;
    public $capacity;
    public $city;
    public $grass_type;
    public $foundation;
    public $scores_home;
    public $formation_home;
    public $scores_away;
    public $formation_away;
   
    
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
                        game.id, game.idteam_home, game.idteam_away, game.idcompetition, game.number_journey,
                        game.date_game, game.time_game, game.idstadium,game.season,
                        team1.nickname as home_nickname, team1.logo_team as home_logo_team, team1.logo_kit_home as home_logo_kit,
                        team2.nickname as away_nickname, team2.logo_team as away_logo_team, team2.logo_kit_away as away_logo_kit,
                        comp.name as name_competition, comp.logo_competition, comp.competition_type, comp.logo_federation,
                        comp.idcountry,
                        coun.name as name_country, coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city,sta.grass_type,sta.foundation
                    FROM 
                        " . $this->table_name . " as game 
                        INNER JOIN teams as team1
                            ON game.idteam_home = team1.id 
                        INNER JOIN teams as team2
                            ON game.idteam_away = team2.id 
                        INNER JOIN competitions as comp 
                            ON game.idcompetition = comp.id 
                        INNER JOIN countries as coun
                            ON coun.id = comp.idcountry
                        INNER JOIN stadiums as sta
                            ON sta.id = game.idstadium  
                    ORDER BY
                        game.time_game ASC";

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
                idteam_home=:idteam_home, 
                idteam_away=:idteam_away, 
                idcompetition=:idcompetition, 
                number_journey=:number_journey, 
                date_game=:date_game, 
                time_game=:time_game, 
                season=:season, 
                idstadium=:idstadium";
                    
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->number_journey = filter_var($this->number_journey, FILTER_SANITIZE_NUMBER_INT);
        $this->date_game = filter_var($this->date_game, FILTER_SANITIZE_STRING);
        $this->time_game = filter_var($this->time_game, FILTER_SANITIZE_STRING);
        $this->season = filter_var($this->season, FILTER_SANITIZE_STRING);
        $this->idstadium = filter_var($this->idstadium, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":number_journey", $this->number_journey);
        $stmt->bindValue(":date_game", $this->date_game);
        $stmt->bindValue(":time_game", $this->time_game);
        $stmt->bindValue(":season", $this->season);
        $stmt->bindValue(":idstadium", $this->idstadium);

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
                    game.id, game.idteam_home, game.idteam_away, game.idcompetition, game.number_journey,
                    game.date_game, game.time_game, game.idstadium,game.season,
                    team1.nickname as home_nickname, team1.logo_team as home_logo_team, team1.logo_kit_home as home_logo_kit,
                    team2.nickname as away_nickname, team2.logo_team as away_logo_team, team2.logo_kit_away as away_logo_kit,
                    comp.name as name_competition, comp.logo_competition, comp.competition_type, comp.logo_federation,
                    comp.idcountry,
                    coun.name as name_country, coun.flag_country,
                    sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city,sta.grass_type,sta.foundation,
                    mat.scores_home,mat.formation_home, mat.scores_away,mat.formation_away

                FROM 
                    " . $this->table_name . " as game 
                    INNER JOIN teams as team1
                        ON game.idteam_home = team1.id 
                    INNER JOIN teams as team2
                        ON game.idteam_away = team2.id 
                    INNER JOIN competitions as comp 
                        ON game.idcompetition = comp.id 
                    INNER JOIN countries as coun
                        ON coun.id = comp.idcountry
                    INNER JOIN stadiums as sta
                        ON sta.id = game.idstadium 
                    LEFT JOIN matchs_results as mat
                        ON mat.idgame_clashe = game.id 
                WHERE
                    game.id = :ID 
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
        $this->idteam_home = $row['idteam_home'];
        $this->idteam_away = $row['idteam_away'];
        $this->idcompetition = $row['idcompetition'];
        $this->number_journey = $row['number_journey'];
        $this->date_game = $row['date_game'];
        $this->time_game = $row['time_game'];
        $this->scores_home = $row['scores_home'];
        $this->scores_away = $row['scores_away'];
        $this->season = $row['season'];
        $this->idstadium = $row['idstadium'];
        $this->home_nickname = $row['home_nickname'];
        $this->home_logo_team = $row['home_logo_team'];
        $this->home_logo_kit = $row['home_logo_kit'];
        $this->away_nickname = $row['away_nickname'];
        $this->away_logo_team = $row['away_logo_team'];
        $this->away_logo_kit = $row['away_logo_kit'];
        $this->name_competition = $row['name_competition'];
        $this->logo_competition = $row['logo_competition'];
        $this->competition_type = $row['competition_type'];
        $this->logo_federation = $row['logo_federation'];
        $this->idcountry = $row['idcountry'];
        $this->name_country = $row['name_country'];
        $this->flag_country = $row['flag_country'];
        $this->name_stadium = $row['name_stadium'];
        $this->logo_stadium = $row['logo_stadium'];
        $this->capacity = $row['capacity'];
        $this->city = $row['city'];
        $this->grass_type = $row['grass_type'];
        $this->foundation = $row['foundation'];
        $this->scores_home = $row['scores_home'];
        $this->formation_home = $row['formation_home'];
        $this->scores_away = $row['scores_away'];
        $this->formation_away = $row['formation_away'];

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
                idteam_home=:idteam_home, 
                idteam_away=:idteam_away, 
                idcompetition=:idcompetition, 
                number_journey=:number_journey, 
                date_game=:date_game, 
                time_game=:time_game, 
                season=:season, 
                idstadium=:idstadium
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away,FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->number_journey = filter_var($this->number_journey, FILTER_SANITIZE_NUMBER_INT);
        $this->date_game = filter_var($this->date_game, FILTER_SANITIZE_STRING);
        $this->time_game = filter_var($this->time_game, FILTER_SANITIZE_STRING);
        $this->season = filter_var($this->season, FILTER_SANITIZE_STRING);
        $this->idstadium = filter_var($this->idstadium, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":number_journey", $this->number_journey);
        $stmt->bindValue(":date_game", $this->date_game);
        $stmt->bindValue(":time_game", $this->time_game);
        $stmt->bindValue(":season", $this->season);
        $stmt->bindValue(":idstadium", $this->idstadium);
        $stmt->bindValue(":id", $this->id);

        // Executar query
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

    // pesquisar competicao por data
    function searchByCompetionIdAndDate($keywords_id, $keywords_date) {

        $query = "SELECT 
                    game.id as idgame, game.idteam_home, game.idteam_away, game.idcompetition,
                    game.date_game, game.time_game,
                    team_home.id as team_home,
                    team_away.id as team_away,
                    team_home.nickname as home_nickname, team_home.logo_team as home_logo_team,
                    team_away.nickname as away_nickname, team_away.logo_team as away_logo_team,
                    mat.scores_home, mat.scores_away
                
                FROM
                    " . $this->table_name . " as game 
                    INNER JOIN teams as team_home
                        ON game.idteam_home = team_home.id 
                    INNER JOIN teams as team_away
                        ON game.idteam_away = team_away.id 
                    LEFT JOIN matchs_results as mat
                        ON mat.idgame_clashe = game.id 
                where game.idcompetition LIKE ? AND game.date_game LIKE ?
                ORDER BY game.time_game ASC";
    
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_id = filter_var($keywords_id,FILTER_SANITIZE_NUMBER_INT);
        $search_data = filter_var($keywords_date,FILTER_SANITIZE_STRING);

        // Atribuir valores 
        $stmt->bindValue(1,$search_id);
        $stmt->bindValue(2,$search_data);

        // Executar query
        $stmt->execute();
        return $stmt;

    }
    // pesquisar paises por data
    function searchByGameDate($keywords) {
        $query = "SELECT 
                        game.id as idgame,game.idcompetition,game.date_game,
                        comp.name as name_competition, comp.logo_competition,comp.idcountry,
                        coun.name,coun.flag_country
                    FROM
                        " . $this->table_name . " as game 
                        INNER JOIN competitions as comp
                        ON game.idcompetition = comp.id  
                        INNER JOIN countries as coun
                        on coun.id = comp.idcountry
                    
                    where game.date_game LIKE ?
                    
                    GROUP BY comp.idcountry 
                    ORDER BY coun.name ASC";
    
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = filter_var($keywords,FILTER_SANITIZE_STRING);

        // Atribuir valores 
        $stmt->bindValue(1,$search);
  

        // Executar query
        $stmt->execute();
        return $stmt;

    }

    function search($keywords) {
        // Query SQL
        $query = "SELECT
                        game.id, game.idteam_home, game.idteam_away, game.number_journey,
                        game.date_game, game.time_game,game.season,
                        team1.nickname as home_nickname, team1.logo_team as home_logo_team, team1.logo_kit_home as home_logo_kit,
                        team2.nickname as away_nickname, team2.logo_team as away_logo_team, team2.logo_kit_away as away_logo_kit,
                        comp.name as name_competition, comp.logo_competition,comp.start_date,comp.end_date,
                        comp.idcountry,
                        coun.name as name_country, coun.flag_country,
                        mat.scores_home, mat.scores_away
                    FROM 
                        games_clashes as game 
                        INNER JOIN teams as team1
                            ON game.idteam_home = team1.id 
                        INNER JOIN teams as team2
                            ON game.idteam_away = team2.id 
                        INNER JOIN competitions as comp 
                            ON game.idcompetition = comp.id 
                        INNER JOIN countries as coun
                            ON coun.id = comp.idcountry
                        LEFT JOIN matchs_results as mat
                            ON mat.idgame_clashe = game.id 
                    WHERE
                        game.idteam_home LIKE ? OR  game.idteam_away LIKE ?
                    ORDER BY
                        game.date_game DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = filter_var($keywords,FILTER_SANITIZE_STRING);
        // Atribuir valores 
        $stmt->bindValue(1, $search);
        $stmt->bindValue(2, $search);

        
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
                        game.id, game.idteam_home, game.idteam_away, game.idcompetition, game.number_journey,
                        game.date_game, game.time_game, game.idstadium,game.season,
                        team1.nickname as home_nickname, team1.logo_team as home_logo_team, team1.logo_kit_home as home_logo_kit,
                        team2.nickname as away_nickname, team2.logo_team as away_logo_team, team2.logo_kit_away as away_logo_kit,
                        comp.name as name_competition, comp.logo_competition, comp.competition_type, comp.logo_federation,
                        comp.idcountry,
                        coun.name as name_country, coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city,sta.grass_type,sta.foundation
                    FROM 
                        " . $this->table_name . " as game 
                        INNER JOIN teams as team1
                            ON game.idteam_home = team1.id 
                        INNER JOIN teams as team2
                            ON game.idteam_away = team2.id 
                        INNER JOIN competitions as comp 
                            ON game.idcompetition = comp.id 
                        INNER JOIN countries as coun
                            ON coun.id = comp.idcountry
                        INNER JOIN stadiums as sta
                            ON sta.id = game.idstadium  
                    ORDER BY
                        game.time_game ASC
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

