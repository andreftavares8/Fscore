<?php

class Teams_Statistics {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "teams_statistics";
    // Propriedades
    public $id;
    public $idmatch_result;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $ball_possession_home;
    public $goal_opportunities_home;
    public $corners_home;
    public $counterattacks_home;
    public $idteam_away;
    public $ball_possession_away;
    public $corners_away;
    public $goal_opportunities_away;
    public $counterattacks_away;
    public $nickname_team_home;
    public $logo_team_home;
    public $nickname_team_away;
    public $logo_team_away;
    
    
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
                        team_stati.id, team_stati.idmatch_result,team_stati.idgame_clashe,team_stati.idcompetition,
                        team_stati.idteam_home,team_stati.ball_possession_home,team_stati.goal_opportunities_home,
                        team_stati.corners_home,team_stati.counterattacks_home,team_stati.idteam_away,team_stati.ball_possession_away,
                        team_stati.corners_away, team_stati.goal_opportunities_away,team_stati.counterattacks_away,           	
                        team_home.nickname as nickname_team_home, team_home.logo_team as logo_team_home,
                        team_away.nickname as nickname_team_away, team_away.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as team_stati
                        INNER JOIN teams as team_home
                            ON team_home.id = team_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = team_stati.idteam_away
                    ORDER BY team_stati.id DESC";

                    
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
                ball_possession_home=:ball_possession_home,
                goal_opportunities_home=:goal_opportunities_home, 
                corners_home=:corners_home,
                counterattacks_home=:counterattacks_home, 
                idteam_away=:idteam_away,
                ball_possession_away=:ball_possession_away, 
                corners_away=:corners_away,
                goal_opportunities_away=:goal_opportunities_away,
                counterattacks_away=:counterattacks_away";
                
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->ball_possession_home = filter_var($this->ball_possession_home, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_opportunities_home = filter_var($this->goal_opportunities_home, FILTER_SANITIZE_NUMBER_INT);
        $this->corners_home =filter_var($this->corners_home, FILTER_SANITIZE_NUMBER_INT);
        $this->counterattacks_home = filter_var($this->counterattacks_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->ball_possession_away = filter_var($this->ball_possession_away, FILTER_SANITIZE_NUMBER_INT);
        $this->corners_away = filter_var($this->corners_away, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_opportunities_away = filter_var($this->goal_opportunities_away, FILTER_SANITIZE_STRING);
        $this->counterattacks_away = filter_var($this->counterattacks_away, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":ball_possession_home", $this->ball_possession_home);
        $stmt->bindValue(":goal_opportunities_home", $this->goal_opportunities_home);
        $stmt->bindValue(":corners_home", $this->corners_home);
        $stmt->bindValue(":counterattacks_home", $this->counterattacks_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":ball_possession_away", $this->ball_possession_away);
        $stmt->bindValue(":corners_away", $this->corners_away);
        $stmt->bindValue(":goal_opportunities_away", $this->goal_opportunities_away);
        $stmt->bindValue(":counterattacks_away", $this->counterattacks_away);

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
                        team_stati.id, team_stati.idmatch_result,team_stati.idgame_clashe,team_stati.idcompetition,
                        team_stati.idteam_home,team_stati.ball_possession_home,team_stati.goal_opportunities_home,
                        team_stati.corners_home,team_stati.counterattacks_home,team_stati.idteam_away,team_stati.ball_possession_away,
                        team_stati.corners_away, team_stati.goal_opportunities_away,team_stati.counterattacks_away,           	
                        team_home.nickname as nickname_team_home, team_home.logo_team as logo_team_home,
                        team_away.nickname as nickname_team_away, team_away.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as team_stati
                        INNER JOIN teams as team_home
                            ON team_home.id = team_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = team_stati.idteam_away
                    WHERE
                        team_stati.id = :ID
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
        $this->ball_possession_home = $row['ball_possession_home'];
        $this->goal_opportunities_home = $row['goal_opportunities_home'];
        $this->corners_home = $row['corners_home'];
        $this->counterattacks_home = $row['counterattacks_home'];
        $this->idteam_away = $row['idteam_away'];
        $this->ball_possession_away = $row['ball_possession_away'];
        $this->corners_away = $row['corners_away'];
        $this->goal_opportunities_away = $row['goal_opportunities_away'];
        $this->counterattacks_away = $row['counterattacks_away'];
        $this->nickname_team_home = $row['nickname_team_home'];
        $this->logo_team_home = $row['logo_team_home'];
        $this->nickname_team_away = $row['nickname_team_away'];
        $this->logo_team_away = $row['logo_team_away'];
        $this->flag_country_player = $row['flag_country_player'];
        $this->name_country_team_entry = $row['name_country_team_entry'];
        $this->flag_country_team_entry = $row['flag_country_team_entry'];
        $this->name_country_team_out = $row['name_country_team_out'];
        $this->flag_country_team_out = $row['flag_country_team_out'];
        $this->date_transfer = $row['date_transfer'];
        $this->transfer_type = $row['transfer_type'];
        $this->valor_transfer = $row['valor_transfer'];
        $this->season = $row['season'];
         
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
                ball_possession_home=:ball_possession_home,
                goal_opportunities_home=:goal_opportunities_home, 
                corners_home=:corners_home,
                counterattacks_home=:counterattacks_home, 
                idteam_away=:idteam_away,
                ball_possession_away=:ball_possession_away, 
                corners_away=:corners_away,
                goal_opportunities_away=:goal_opportunities_away,
                counterattacks_away=:counterattacks_away
            WHERE
            id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->ball_possession_home = filter_var($this->ball_possession_home, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_opportunities_home = filter_var($this->goal_opportunities_home, FILTER_SANITIZE_NUMBER_INT);
        $this->corners_home =filter_var($this->corners_home, FILTER_SANITIZE_NUMBER_INT);
        $this->counterattacks_home = filter_var($this->counterattacks_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->ball_possession_away = filter_var($this->ball_possession_away, FILTER_SANITIZE_NUMBER_INT);
        $this->corners_away = filter_var($this->corners_away, FILTER_SANITIZE_NUMBER_INT);
        $this->goal_opportunities_away = filter_var($this->goal_opportunities_away, FILTER_SANITIZE_STRING);
        $this->counterattacks_away = filter_var($this->counterattacks_away, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":ball_possession_home", $this->ball_possession_home);
        $stmt->bindValue(":goal_opportunities_home", $this->goal_opportunities_home);
        $stmt->bindValue(":corners_home", $this->corners_home);
        $stmt->bindValue(":counterattacks_home", $this->counterattacks_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":ball_possession_away", $this->ball_possession_away);
        $stmt->bindValue(":corners_away", $this->corners_away);
        $stmt->bindValue(":goal_opportunities_away", $this->goal_opportunities_away);
        $stmt->bindValue(":counterattacks_away", $this->counterattacks_away);
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
                        team_stati.id, team_stati.idmatch_result,team_stati.idgame_clashe,team_stati.idcompetition,
                        team_stati.idteam_home,team_stati.ball_possession_home,team_stati.goal_opportunities_home,
                        team_stati.corners_home,team_stati.counterattacks_home,team_stati.idteam_away,team_stati.ball_possession_away,
                        team_stati.corners_away, team_stati.goal_opportunities_away,team_stati.counterattacks_away,           	
                        team_home.nickname as nickname_team_home, team_home.logo_team as logo_team_home,
                        team_away.nickname as nickname_team_away, team_away.logo_team as logo_team_away
                    FROM
                    teams_statistics as team_stati
                        INNER JOIN teams as team_home
                            ON team_home.id = team_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = team_stati.idteam_away
                    
                    WHERE
                    
                        team_stati.idgame_clashe = ?
                        ORDER BY team_stati.id DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = filter_var($keywords,FILTER_SANITIZE_NUMBER_INT);

        // Atribuir valores 
        $stmt->bindValue(1, $search);

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
                        team_stati.id, team_stati.idmatch_result,team_stati.idgame_clashe,team_stati.idcompetition,
                        team_stati.idteam_home,team_stati.ball_possession_home,team_stati.goal_opportunities_home,
                        team_stati.corners_home,team_stati.counterattacks_home,team_stati.idteam_away,team_stati.ball_possession_away,
                        team_stati.corners_away, team_stati.goal_opportunities_away,team_stati.counterattacks_away,           	
                        team_home.nickname as nickname_team_home, team_home.logo_team as logo_team_home,
                        team_away.nickname as nickname_team_away, team_away.logo_team as logo_team_away
                    FROM
                        " . $this->table_name . " as team_stati
                        INNER JOIN teams as team_home
                            ON team_home.id = team_stati.idteam_home
                        INNER JOIN teams as team_away
                            ON team_away.id = team_stati.idteam_away
                    ORDER BY team_stati.id DESC
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

