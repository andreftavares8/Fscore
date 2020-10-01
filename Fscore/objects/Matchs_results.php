<?php

class Matchs_Results {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "matchs_results";
    // Propriedades
    public $id;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $formation_home;
    public $scores_home;
    public $idteam_away;
    public $formation_away;
    public $scores_away;
    public $name_competition;
    public $logo_competition;
    public $home_nickname;
    public $home_logo_team;
    public $away_nickname;
    public $away_logo_team;
   
    
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
                            mat.id, mat.idgame_clashe, mat.idcompetition, mat.idteam_home, mat.formation_home, 
                            mat.scores_home,mat.idteam_away, mat.formation_away, mat.scores_away,
                            comp.name as name_competition,comp.logo_competition,comp.start_date,comp.end_date,
                            team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,
                            team_away.nickname as away_nickname,team_away.logo_team as away_logo_team,
                            game.date_game
                            
                        FROM
                            " . $this->table_name ." as mat
                            
                            JOIN competitions as comp
                                ON comp.id = mat.idcompetition
                            JOIN teams as team_home
                                ON team_home.id = mat.idteam_home
                            JOIN teams as team_away
                                ON team_away.id = mat.idteam_away
                            JOIN games_clashes as game
                                ON game.id = mat.idgame_clashe
                            WHERE mat.idcompetition = 6
                            ORDER BY comp.name ASC";

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
                idgame_clashe=:idgame_clashe,
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                formation_home=:formation_home,
                scores_home=:scores_home,
                idteam_away=:idteam_away, 
                formation_away=:formation_away,
                scores_away=:scores_away";
               
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var ($this->idcompetition,FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->formation_home = filter_var($this->formation_home, FILTER_SANITIZE_STRING);
        $this->scores_home = filter_var($this->scores_home,FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->formation_away = filter_var($this->formation_away, FILTER_SANITIZE_STRING);
        $this->scores_away = filter_var($this->scores_away, FILTER_SANITIZE_NUMBER_INT);
     
        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":formation_home", $this->formation_home);
        $stmt->bindValue(":scores_home", $this->scores_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":formation_away", $this->formation_away);
        $stmt->bindValue(":scores_away", $this->scores_away);
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
                        mat.id, mat.idgame_clashe, mat.idcompetition, mat.idteam_home, mat.formation_home, 
                        mat.scores_home,mat.idteam_away, mat.formation_away, mat.scores_away,
                        comp.name as name_competition,comp.logo_competition,
                        team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,
                        team_away.nickname as away_nickname,team_away.logo_team as away_logo_team
                    FROM
                        " . $this->table_name ." as mat
                        
                        JOIN competitions as comp
                            ON comp.id = mat.idcompetition
                        JOIN teams as team_h
                            ON team_h.id = mat.idteam_home
                        JOIN teams as team_a
                            ON team_a.id = mat.idteam_away
                    WHERE 
                        mat.id = :ID
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
        $this->formation_home = $row['formation_home'];
        $this->scores_home = $row['scores_home'];
        $this->idteam_away = $row['idteam_away'];
        $this->formation_away = $row['formation_away'];
        $this->scores_away = $row['scores_away'];
        $this->name_competition = $row['name_competition'];
        $this->logo_competition = $row['logo_competition'];
        $this->home_nickname = $row['home_nickname'];
        $this->home_logo_team = $row['home_logo_team'];
        $this->away_nickname = $row['away_nickname'];
        $this->away_logo_team = $row['away_logo_team'];
          
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
                idgame_clashe=:idgame_clashe,
                idcompetition=:idcompetition, 
                idteam_home=:idteam_home,
                formation_home=:formation_home,
                scores_home=:scores_home,
                idteam_away=:idteam_away, 
                formation_away=:formation_away,
                scores_away=:scores_away
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var ($this->idcompetition,FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->formation_home = filter_var($this->formation_home, FILTER_SANITIZE_STRING);
        $this->scores_home = filter_var($this->scores_home,FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->formation_away = filter_var($this->formation_away, FILTER_SANITIZE_STRING);
        $this->scores_away = filter_var($this->scores_away, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":formation_home", $this->formation_home);
        $stmt->bindValue(":scores_home", $this->scores_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":formation_away", $this->formation_away);
        $stmt->bindValue(":scores_away", $this->scores_away);
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
    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        mat.id, mat.idgame_clashe, mat.idcompetition, mat.idteam_home, mat.formation_home, 
                        mat.scores_home,mat.idteam_away, mat.formation_away, mat.scores_away,
                        comp.name as name_competition,comp.logo_competition,
                        team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,
                        team_away.nickname as away_nickname,team_away.logo_team as away_logo_team
                    FROM
                        " . $this->table_name ." as mat
                        
                        JOIN competitions as comp
                            ON comp.id = mat.idcompetition
                        JOIN teams as team_h
                            ON team_h.id = mat.idteam_home
                        JOIN teams as team_a
                            ON team_a.id = mat.idteam_away
                    WHERE 
                        mat.idgame_clashe LIKE ? OR mat.idcompetition LIKE ?
                    ORDER BY comp.name ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
       $stmt->bindValue(1,$search);
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
                        mat.id, mat.idgame_clashe, mat.idcompetition, mat.idteam_home, mat.formation_home, 
                        mat.scores_home,mat.idteam_away, mat.formation_away, mat.scores_away,
                        comp.name as name_competition,comp.logo_competition,
                        team_home.nickname as home_nickname,team_home.logo_team as home_logo_team,
                        team_away.nickname as away_nickname,team_away.logo_team as away_logo_team
                    FROM
                        " . $this->table_name ." as mat
                        
                        JOIN competitions as comp
                            ON comp.id = mat.idcompetition
                        JOIN teams as team_h
                            ON team_h.id = mat.idteam_home
                        JOIN teams as team_a
                            ON team_a.id = mat.idteam_away
                        ORDER BY comp.name ASC
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
