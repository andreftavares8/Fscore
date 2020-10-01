<?php

class Teams_Competitions {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "teams_competitions";
    // Propriedades
    public $id;
    public $idteam;
    public $idcompetition;
    public $league_group;
    public $league_title;
    public $nickname_team;
    public $logo_team;
    public $name_competition;
    public $logo_competition;
    public $competition_type;
    public $logo_federation;
    public $logo_trophie;
    public $idcountry;
    public $season;
    public $name_country;
    public $flag_country;
    public $start_date;
    public $end_date;

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
                    team_comp.id,team_comp.idteam,team_comp.idcompetition,team_comp.league_group,team_comp.league_title,
                    team.nickname as nickname_team, team.logo_team, 
                    comp.name as name_competition, comp.logo_competition, comp.competition_type, 
                    comp.logo_federation,comp.logo_trophie,comp.idcountry,comp.season,comp.season,comp.start_date,comp.end_date,
                    coun.name as name_country, coun.flag_country
                FROM
                    " . $this->table_name . " as team_comp
                    INNER JOIN teams as team
                        ON team.id = team_comp.idteam
                    INNER JOIN competitions as comp
                        ON comp.id = team_comp.idcompetition
                    INNER JOIN countries as coun
                        ON coun.id = comp.idcountry
                    ORDER BY comp.season DESC";
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
                idteam=:idteam, 
                idcompetition=:idcompetition, 
                league_group=:league_group, 
                league_title=:league_title";
             
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition =filter_var($this->idcompetition,FILTER_SANITIZE_NUMBER_INT);
        $this->league_group = filter_var($this->league_group, FILTER_SANITIZE_STRING);
        $this->league_title = filter_var($this->league_title, FILTER_SANITIZE_STRING);
        

        // Associar valores
        $stmt->bindValue(":idteam", $this->idteam);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":league_group", $this->league_group);
        $stmt->bindValue(":league_title", $this->league_title);

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
                        team_comp.id,team_comp.idteam,team_comp.idcompetition,team_comp.league_group,team_comp.league_title,
                        team.nickname as nickname_team, team.logo_team, 
                        comp.name as name_competition, comp.logo_competition, comp.competition_type, 
                        comp.logo_federation,comp.logo_trophie,comp.idcountry,comp.season,
                        coun.name as name_country, coun.flag_country
                    FROM
                        " . $this->table_name . " as team_comp
                        INNER JOIN teams as team
                            ON team.id = team_comp.idteam
                        INNER JOIN competitions as comp
                            ON comp.id = team_comp.idcompetition
                        INNER JOIN countries as coun
                            ON coun.id = comp.idcountry
                        ORDER BY comp.season DESC
                    WHERE
                        team_comp.id = :ID 
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
        $this->idteam = $row['idteam'];
        $this->idcompetition = $row['idcompetition'];
        $this->league_group = $row['league_group'];
        $this->league_title = $row['league_title'];
        $this->nickname_team = $row['nickname_team'];
        $this->logo_team = $row['logo_team'];
        $this->name_competition = $row['name_competition'];
        $this->logo_competition = $row['logo_competition'];
        $this->competition_type = $row['competition_type'];
        $this->logo_federation = $row['logo_federation'];
        $this->logo_trophie = $row['logo_trophie'];
        $this->season = $row['season'];
        $this->idcountry = $row['idcountry'];
        $this->name_country = $row['name_country'];
        $this->flag_country = $row['flag_country'];
        $this->start_date = $row['start_date'];
        $this->end_date = $row['end_date'];     
        
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
                idteam=:idteam, 
                idcompetition=:idcompetition, 
                league_group=:league_group, 
                league_title=:league_title
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition =filter_var($this->idcompetition,FILTER_SANITIZE_NUMBER_INT);
        $this->league_group = filter_var($this->league_group, FILTER_SANITIZE_STRING);
        $this->league_title = filter_var($this->league_title, FILTER_SANITIZE_STRING);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":idteam", $this->idteam);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":league_group", $this->league_group);
        $stmt->bindValue(":league_title", $this->league_title);
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
                    team_comp.id,team_comp.idteam,team_comp.idcompetition,team_comp.league_group,team_comp.league_title,
                    team.nickname as nickname_team, team.logo_team, 
                    comp.name as name_competition, comp.logo_competition, comp.competition_type, 
                    comp.logo_federation,comp.logo_trophie,comp.idcountry,comp.season,comp.start_date,comp.end_date,
                    coun.name as name_country, coun.flag_country
                FROM
                    " . $this->table_name . " as team_comp
                    LEFT JOIN teams as team
                        ON team.id = team_comp.idteam
                    LEFT JOIN competitions as comp
                        ON comp.id = team_comp.idcompetition
                    LEFT JOIN countries as coun
                        ON coun.id = comp.idcountry
                    WHERE
                        team.nickname LIKE ? OR comp.name LIKE ? OR team_comp.idteam LIKE ?
                    GROUP BY  comp.name
                    ORDER BY comp.season DESC";

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
                    team_comp.id,team_comp.idteam,team_comp.idcompetition,team_comp.league_group,team_comp.league_title,
                    team.nickname as nickname_team, team.logo_team, 
                    comp.name as name_competition, comp.logo_competition, comp.competition_type, 
                    comp.logo_federation,comp.logo_trophie,comp.idcountry,comp.season,
                    coun.name as name_country, coun.flag_country
                FROM
                    " . $this->table_name . " as team_comp
                    INNER JOIN teams as team
                        ON team.id = team_comp.idteam
                    INNER JOIN competitions as comp
                        ON comp.id = team_comp.idcompetition
                    INNER JOIN countries as coun
                        ON coun.id = comp.idcountry
                    ORDER BY comp.season DESC
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

