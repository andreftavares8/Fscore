<?php

class Competitions {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "competitions";
    // Propriedades
    public $id;
    public $name;
    public $competition_type;
    public $start_date;
    public $end_date;
    public $number_journeys;
    public $logo_competition;
    public $logo_federation;
    public $logo_trophie;
    public $season;
    public $idcountry;
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
                        comp.id as idcompetition,comp.name,comp.competition_type,comp.start_date,comp.end_date,comp.number_journeys,
                        comp.logo_competition,comp.logo_federation,comp.logo_trophie,comp.season,comp.idcountry,
                        coun.name as name_country,coun.flag_country,team.id as idteam,team.nickname
                    FROM
                        competitions as comp
                        INNER JOIN 
                            countries as coun
                            ON comp.idcountry = coun.id
                        INNER JOIN 
                        teams as team
                        ON coun.id = team.idcountry
                    WHERE comp.season = ".'"2019/2020"'." and team.nickname = coun.name
                    GROUP BY coun.id
                    ORDER BY 
                            coun.name ASC";
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
                name=:name,
                competition_type=:competition_type, 
                start_date=:start_date,
                end_date=:end_date,
                number_journeys=:number_journeys, 
                logo_competition=:logo_competition,
                logo_federation=:logo_federation,
                logo_trophie=:logo_trophie,
                season=:season,
                idcountry=:idcountry";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->competition_type = filter_var ($this->competition_type,FILTER_SANITIZE_STRING);
        $this->start_date = filter_var($this->start_date, FILTER_SANITIZE_STRING);
        $this->end_date = filter_var($this->end_date, FILTER_SANITIZE_STRING);
        $this->number_journeys = filter_var($this->number_journeys,FILTER_SANITIZE_NUMBER_INT);
        $this->logo_competition = filter_var($this->logo_competition, FILTER_SANITIZE_STRING);
        $this->logo_federation = filter_var($this->logo_federation, FILTER_SANITIZE_STRING);
        $this->logo_trophie = filter_var($this->logo_trophie, FILTER_SANITIZE_STRING);
        $this->season = filter_var($this->season, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry,FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":competition_type", $this->competition_type);
        $stmt->bindValue(":start_date", $this->start_date);
        $stmt->bindValue(":end_date", $this->end_date);
        $stmt->bindValue(":number_journeys", $this->number_journeys);
        $stmt->bindValue(":logo_competition", $this->logo_competition);
        $stmt->bindValue(":logo_federation", $this->logo_federation);
        $stmt->bindValue(":logo_trophie", $this->logo_trophie);
        $stmt->bindValue(":season", $this->season);
        $stmt->bindValue(":idcountry", $this->idcountry);

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
                    comp.id, comp.name, comp.competition_type, comp.start_date, comp.end_date, comp.number_journeys,
                    comp.logo_competition, comp.logo_federation, comp.logo_trophie, comp.season, comp.idcountry,
                    pai.name as name_country, pai.flag_country
                FROM
                    " . $this->table_name . " as comp
                    INNER JOIN 
                        countries as pai
                            ON pai.id = comp.idcountry
                WHERE 
                    comp.id = :ID
                LIMIT 0,1";
 
        $stmt = $this->conn->prepare($query);
        // Filtrar e associar valor do ID
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $stmt->bindValue(':ID', $this->id);

        // Executar query
        $stmt->execute();
        
        // Obter dados do registo e instanciar o objeto
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->competition_type = $row['competition_type'];
        $this->start_date = $row['start_date'];
        $this->end_date = $row['end_date'];
        $this->number_journeys = $row['number_journeys'];
        $this->logo_competition = $row['logo_competition'];
        $this->logo_federation = $row['logo_federation'];
        $this->logo_trophie = $row['logo_trophie'];
        $this->season = $row['season'];
        $this->idcountry = $row['idcountry'];
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
                name = :name,
                competition_type = :competition_type,
                start_date = :start_date,
                end_date = :end_date,
                number_journeys = :number_journeys,
                logo_competition = :logo_competition,
                logo_federation = :logo_federation,
                logo_trophie = :logo_trophie,
                season = :season,
                idcountry = :idcountry
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->competition_type = filter_var($this->competition_type, FILTER_SANITIZE_STRING);
        $this->start_date = filter_var($this->start_date, FILTER_SANITIZE_STRING);
        $this->end_date = filter_var($this->end_date, FILTER_SANITIZE_STRING);
        $this->number_journeys = filter_var($this->number_journeys, FILTER_SANITIZE_NUMBER_INT);
        $this->logo_competition = filter_var($this->logo_competition, FILTER_SANITIZE_NUMBER_INT);
        $this->logo_federation = filter_var($this->logo_federation, FILTER_SANITIZE_STRING);
        $this->season = filter_var($this->season, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":competition_type", $this->competition_type);
        $stmt->bindValue(":start_date", $this->start_date);
        $stmt->bindValue(":end_date", $this->end_date);
        $stmt->bindValue(":number_journeys", $this->number_journeys);
        $stmt->bindValue(":logo_competition", $this->logo_competition);
        $stmt->bindValue(":logo_federation", $this->logo_federation);
        $stmt->bindValue(":logo_trophie", $this->logo_trophie);
        $stmt->bindValue(":season", $this->season);
        $stmt->bindValue(":idcountry", $this->idcountry);
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
    // pesquisa competicao por pais
    function searchCompByCountry($keywords) {
        $query = "SELECT
                        comp.id as idcompetition, comp.name, comp.competition_type,
                        comp.logo_competition, comp.logo_federation,comp.idcountry,
                        coun.name name_country,coun.flag_country
                    FROM
                        " . $this->table_name . " as comp
                        INNER JOIN countries as coun 
                            ON coun.id = comp.idcountry 
                        where 
                            comp.idcountry LIKE ? 
                        GROUP BY 
                            comp.name
                        ORDER BY 
                            comp.id ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_data = '%'.filter_var($keywords,FILTER_SANITIZE_NUMBER_INT).'%';

        // Atribuir valores 
        $stmt->bindValue(1,$keywords);
        // Executar query
        $stmt->execute();
        return $stmt;
    }
    // pesquisa competicao por pais
    function searchCompetitionByCountry($keywords_id, $keywords_date) {
        $query = "SELECT
                        comp.id as idcompetition, comp.name, comp.competition_type,
                        comp.logo_competition, comp.logo_federation,comp.idcountry,
                        game.id as idgame_clashe 
                    FROM
                        " . $this->table_name . " as comp
                        INNER JOIN games_clashes as game 
                            ON game.idcompetition = comp.id  
                        where 
                            comp.idcountry LIKE ? and  game.date_game LIKE ?
                        GROUP BY 
                            comp.id
                        ORDER BY 
                            comp.id ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_id = '%'.filter_var($keywords_id,FILTER_SANITIZE_NUMBER_INT).'%';
        $search_data = '%'.filter_var($keywords_date,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
        $stmt->bindValue(1,$search_id);
        $stmt->bindValue(2, $search_data);
        // Executar query
        $stmt->execute();
        return $stmt;
    }


    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        comp.id,comp.name,comp.competition_type,comp.start_date,comp.end_date,comp.number_journeys,
                        comp.logo_competition,comp.logo_federation,comp.logo_trophie,comp.season,comp.idcountry,
                        coun.name name_country,coun.flag_country
                    FROM
                        " . $this->table_name . " as comp
                        INNER JOIN countries as coun
                            ON comp.idcountry = coun.id
                    WHERE
                        comp.name LIKE ? OR comp.competition_type LIKE ?
                    GROUP BY 
                        comp.name
                    ORDER BY 
                        comp.id ASC";

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
                    comp.id,comp.name,comp.competition_type,comp.start_date,comp.end_date,comp.number_journeys,
                    comp.logo_competition,comp.logo_federation,comp.logo_trophie,comp.season,comp.idcountry,
                    pai.name as name_country,pai.flag_country
                FROM
                    " . $this->table_name . " as comp
                    INNER JOIN 
                        countries as pai
                            ON comp.idcountry = pai.id
                ORDER BY 
                    comp.season DESC
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
