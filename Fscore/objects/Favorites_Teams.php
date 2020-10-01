<?php

class Favorites_Teams {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "favorites_teams";
    // Propriedades~
    public $id;
    public $iduser;
    public $idteam;
    public $name_user;
    public $nickname_team;
    public $logo_team;
    public $idcountry;
    public $name_country;
    public $flag_country;
    public $seg;
    
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
                        fav_team.id,fav_team.iduser, fav_team.idteam,
                        user.username as name_user,
                        team.nickname as nickname_team, team.logo_team,team.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_team
                        INNER JOIN users as user
                            ON user.id = fav_team.iduser
                        INNER JOIN teams as team
                            ON team.id = fav_team.idteam
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id  
                    ORDER BY team.nickname ASC";

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
                idteam=:idteam";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
       
        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idteam", $this->idteam);
       

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
                        fav_team.id,fav_team.iduser, fav_team.idteam,
                        user.username as name_user,
                        team.nickname as nickname_team, team.logo_team,team.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_team
                        INNER JOIN users as user
                            ON user.id = fav_team.iduser
                        INNER JOIN teams as team
                            ON team.id = fav_team.idteam
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id  
                    WHERE fav_team.idteam = :ID
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
        $this->idteam = $row['idteam'];
        $this->nickname_team = $row['nickname_team'];
        $this->logo_team = $row['logo_team'];
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
                
                idteam = :idteam,
                iduser = :iduser
                
            WHERE
            id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idteam", $this->idteam);
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
    /************************************
     * pesquisa de numero de seguidores 
     ***********************************/
    function searchSegTeam($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        id,iduser,COUNT(idteam) as seg
                    FROM 
                        " . $this->table_name . "
                        
                    WHERE   idteam = ?
                    ";

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
    function searchByUserByTeams($keywords_user,$keywords_team) {
        // Query SQL
        $query = "SELECT                    	
                        fav_team.id,fav_team.iduser, fav_team.idteam,
                        user.username as name_user,
                        team.nickname as nickname_team, team.logo_team,team.idcountry,
                        coun.name as country_name, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_team
                        LEFT JOIN users as user
                            ON user.id = fav_team.iduser
                        LEFT JOIN teams as team
                            ON team.id = fav_team.idteam
                        LEFT JOIN countries as coun
                            ON team.idcountry = coun.id  
                    WHERE   fav_team.iduser = ? and fav_team.idteam = ?
                    ORDER BY team.nickname ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_user = filter_var($keywords_user,FILTER_SANITIZE_NUMBER_INT);
        $search_team = filter_var($keywords_team,FILTER_SANITIZE_NUMBER_INT);
        // Atribuir valores 
        $stmt->bindValue(1, $search_user);
        $stmt->bindValue(2, $search_team);

        // Executar query
        $stmt->execute();

        return $stmt;
    }

     
    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        fav_team.id,fav_team.iduser, fav_team.idteam,
                        user.username as name_user,
                        team.nickname as nickname_team, team.logo_team,team.idcountry,
                        coun.name as country_name, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_team
                        LEFT JOIN users as user
                            ON user.id = fav_team.iduser
                        LEFT JOIN teams as team
                            ON team.id = fav_team.idteam
                        LEFT JOIN countries as coun
                            ON team.idcountry = coun.id  
                    WHERE  team.nickname LIKE ? OR fav_team.iduser LIKE ?
                    ORDER BY team.nickname ASC";

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
                        fav_team.id, fav_team.iduser, fav_team.idteam,
                        user.username as name_user,
                        team.nickname as nickname_team, team.logo_team,team.idcountry,
                        coun.name as country_name, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_team
                        INNER JOIN users as user
                            ON user.id = fav_team.iduser
                        INNER JOIN teams as team
                            ON team.id = fav_team.idteam
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id  
                    ORDER BY team.nickname ASC
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