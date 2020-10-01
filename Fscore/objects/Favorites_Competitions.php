<?php

class Favorites_Competitions {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "favorites_competitions";
    // Propriedades
    public $id;
    public $iduser;
    public $idcompetition;
    public $name_user;
    public $name_competition;
    public $logo_competition;
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
                        fav_comp.id,fav_comp.iduser, fav_comp.idcompetition,
                        user.username as name_user,
                        comp.name as name_competition, comp.logo_competition,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_comp
                        INNER JOIN users as user
                            ON user.id = fav_comp.iduser
                        INNER JOIN competitions as comp
                            ON comp.id = fav_comp.idcompetition
                        INNER JOIN countries as coun
                            ON comp.idcountry = coun.id  
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
               
                iduser=:iduser, 
                idcompetition=:idcompetition";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
       
        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
       

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
                            fav_comp.id,fav_comp.iduser, fav_comp.idcompetition,
                            user.username as name_user,
                            comp.name as name_competition, comp.logo_competition,comp.idcountry,
                            coun.name as name_country, coun.flag_country
                        FROM 
                            " . $this->table_name . " as fav_comp
                            INNER JOIN users as user
                                ON user.id = fav_comp.iduser
                            INNER JOIN competitions as comp
                                ON comp.id = fav_comp.idcompetition
                            INNER JOIN countries as coun
                                ON comp.idcountry = coun.id  
                        WHERE fav_comp.id = :ID 
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
        $this->iduser = $row['iduser'];
        $this->name_user = $row['name_user'];
        $this->idcompetition = $row['idcompetition'];
        $this->name_competition = $row['name_competition'];
        $this->logo_competition = $row['logo_competition'];
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
                        iduser = :iduser,
                        idcompetition = :idcompetition
                    WHERE
                    id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
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
    function searchSegComp($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        id,iduser, COUNT(idcompetition) as seg
                    FROM 
                        " . $this->table_name . "
                        
                    WHERE   idcompetition LIKE ?";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search);

        // Executar query
        $stmt->execute();

        return $stmt;
    }
    function searchByUserByCompetitions($keywords_user,$keywords_comp) {
        // Query SQL
        $query = "SELECT                    	
                        fav_comp.id,fav_comp.iduser, fav_comp.idcompetition,
                        user.username as name_user,
                        comp.name as name_competition, comp.logo_competition,comp.competition_type,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        favorites_competitions as fav_comp
                        INNER JOIN users as user
                            ON user.id = fav_comp.iduser
                        INNER JOIN competitions as comp
                            ON comp.id = fav_comp.idcompetition
                        INNER JOIN countries as coun
                            ON comp.idcountry = coun.id  
                    WHERE  fav_comp.iduser = ? AND fav_comp.idcompetition = ?
                    GROUP BY fav_comp.idcompetition
                    ORDER BY comp.name ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_user = filter_var($keywords_user,FILTER_SANITIZE_NUMBER_INT);
        $search_comp = filter_var($keywords_comp,FILTER_SANITIZE_NUMBER_INT);
        // Atribuir valores 
        $stmt->bindValue(1, $search_user);
        $stmt->bindValue(2, $search_comp);

        // Executar query
        $stmt->execute();

        return $stmt;
    }

    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        fav_comp.id,fav_comp.iduser, fav_comp.idcompetition,
                        user.username as name_user,
                        comp.name as name_competition, comp.logo_competition,comp.competition_type,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_comp
                        INNER JOIN users as user
                            ON user.id = fav_comp.iduser
                        INNER JOIN competitions as comp
                            ON comp.id = fav_comp.idcompetition
                        INNER JOIN countries as coun
                            ON comp.idcountry = coun.id  
                    WHERE  comp.name LIKE ? OR fav_comp.iduser LIKE ?
                    GROUP BY fav_comp.idcompetition
                    ORDER BY comp.name ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

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
                        fav_comp.id,fav_comp.iduser, fav_comp.idcompetition,
                        user.username as name_user,
                        comp.name as name_competition, comp.logo_competition,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_comp
                        INNER JOIN users as user
                            ON user.id = fav_comp.iduser
                        INNER JOIN competitions as comp
                            ON comp.id = fav_comp.idcompetition
                        INNER JOIN countries as coun
                            ON comp.idcountry = coun.id  
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