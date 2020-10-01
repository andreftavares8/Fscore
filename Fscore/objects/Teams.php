<?php

class Teams {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "teams";
    // Propriedades
    public $id;
    public $name;
    public $nickname;
    public $city;
    public $foundation;
    public $president;
    public $email;
    public $website;
    public $logo_team;
    public $logo_kit_home;
    public $logo_kit_away;
    public $idcountry;
    public $idstadium;
    public $name_country;
    public $flag_country;
    public $name_stadium;
    public $logo_stadium;
    public $capacity;
    public $city_stadium;
    public $foundation_stadium;
    public $grass_type;
   
 
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
                        team.id,team.name,team.nickname,team.city,team.foundation,team.president,team.email,team.website,
                        team.logo_team,team.logo_kit_home,team.logo_kit_away,team.idcountry,team.idstadium,
                        coun.name as name_country,coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city as city_stadium,sta.foundation as foundation_stadium,
                        sta.grass_type
                    FROM
                        " . $this->table_name . " as team
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id
                        INNER JOIN stadiums as sta
                            ON  team.idstadium = sta.id
                    ORDER BY 
                        team.nickname  ASC";

   
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
                nickname=:nickname, 
                city=:city,
                foundation=:foundation,
                president=:president,
                email=:email,
                website=:website,
                logo_team=:logo_team, 
                logo_kit_home=:logo_kit_home,
                logo_kit_away=:logo_kit_away,
                idcountry=:idcountry,
                idstadium=:idstadium";
                 
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->nickname = filter_var ($this->nickname,FILTER_SANITIZE_STRING);
        $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
        $this->foundation = filter_var($this->foundation, FILTER_SANITIZE_STRING);
        $this->president = filter_var($this->president,FILTER_SANITIZE_STRING);
        $this->email = filter_var($this->email, FILTER_SANITIZE_STRING);
        $this->website = filter_var($this->website,FILTER_SANITIZE_STRING);
        $this->logo_team = filter_var($this->logo_team, FILTER_SANITIZE_STRING);
        $this->logo_kit_home = filter_var($this->logo_kit_home, FILTER_SANITIZE_STRING);
        $this->logo_kit_away = filter_var($this->logo_kit_away, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        $this->idstadium = filter_var($this->idstadium,FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":nickname", $this->nickname);
        $stmt->bindValue(":city", $this->city);
        $stmt->bindValue(":foundation", $this->foundation);
        $stmt->bindValue(":president", $this->president);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":website", $this->website);
        $stmt->bindValue(":logo_team", $this->logo_team);
        $stmt->bindValue(":logo_kit_home", $this->logo_kit_home);
        $stmt->bindValue(":logo_kit_away", $this->logo_kit_away);
        $stmt->bindValue(":idcountry", $this->idcountry);
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
                        team.id,team.name,team.nickname,team.city,team.foundation,team.president,team.email,team.website,
                        team.logo_team,team.logo_kit_home,team.logo_kit_away,team.idcountry,team.idstadium,
                        coun.name as name_country,coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city as city_stadium,sta.foundation as foundation_stadium,
                        sta.grass_type
                    FROM
                        " . $this->table_name . " as team
                        LEFT JOIN countries as coun
                            ON team.idcountry = coun.id
                        LEFT JOIN stadiums as sta
                            ON  team.idstadium = sta.id
                    WHERE 
                        team.id = :ID
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
        $this->name = $row['name'];
        $this->nickname = $row['nickname'];
        $this->city = $row['city'];
        $this->foundation = $row['foundation'];
        $this->president = $row['president'];
        $this->email = $row['email'];
        $this->website = $row['website'];
        $this->logo_team = $row['logo_team'];
        $this->logo_kit_home = $row['logo_kit_home'];
        $this->logo_kit_away = $row['logo_kit_away'];
        $this->idcountry = $row['idcountry'];
        $this->idstadium = $row['idstadium'];
        $this->name_country = $row['name_country'];
        $this->flag_country = $row['flag_country'];
        $this->name_stadium = $row['name_stadium'];
        $this->logo_stadium = $row['logo_stadium'];
        $this->capacity = $row['capacity'];
        $this->city_stadium = $row['city_stadium'];
        $this->foundation_stadium = $row['foundation_stadium'];
        $this->grass_type = $row['grass_type'];
             
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
                name=:name,
                nickname=:nickname, 
                city=:city,
                foundation=:foundation,
                president=:president,
                email=:email,
                website=:website,
                logo_team=:logo_team, 
                logo_kit_home=:logo_kit_home,
                logo_kit_away=:logo_kit_away,
                idcountry=:idcountry,
                idstadium=:idstadium
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->nickname = filter_var ($this->nickname,FILTER_SANITIZE_STRING);
        $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
        $this->foundation = filter_var($this->foundation, FILTER_SANITIZE_STRING);
        $this->president = filter_var($this->president,FILTER_SANITIZE_STRING);
        $this->email = filter_var($this->email, FILTER_SANITIZE_STRING);
        $this->website = filter_var($this->website,FILTER_SANITIZE_STRING);
        $this->logo_team = filter_var($this->logo_team, FILTER_SANITIZE_STRING);
        $this->logo_kit_home = filter_var($this->logo_kit_home, FILTER_SANITIZE_STRING);
        $this->logo_kit_away = filter_var($this->logo_kit_away, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        $this->idstadium = filter_var($this->idstadium,FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":nickname", $this->nickname);
        $stmt->bindValue(":city", $this->city);
        $stmt->bindValue(":foundation", $this->foundation);
        $stmt->bindValue(":president", $this->president);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":website", $this->website);
        $stmt->bindValue(":logo_team", $this->logo_team);
        $stmt->bindValue(":logo_kit_home", $this->logo_kit_home);
        $stmt->bindValue(":logo_kit_away", $this->logo_kit_away);
        $stmt->bindValue(":idcountry", $this->idcountry);
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
    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        team.id,team.name,team.nickname,team.city,team.foundation,team.president,team.email,team.website,
                        team.logo_team,team.logo_kit_home,team.logo_kit_away,team.idcountry,team.idstadium,
                        coun.name as name_country,coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city as city_stadium,sta.foundation as foundation_stadium,
                        sta.grass_type
                    FROM
                        " . $this->table_name . " as team
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id
                        INNER JOIN stadiums as sta
                            ON  team.idstadium = sta.id
                    WHERE 
                        team.nickname LIKE ? OR team.id LIKE ?
                    ORDER BY 
                        team.nickname  ASC";

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
                        team.id,team.name,team.nickname,team.city,team.foundation,team.president,team.email,team.website,
                        team.logo_team,team.logo_kit_home,team.logo_kit_away,team.idcountry,team.idstadium,
                        coun.name as name_country,coun.flag_country,
                        sta.name as name_stadium,sta.logo_stadium,sta.capacity,sta.city as city_stadium,sta.foundation as foundation_stadium,
                        sta.grass_type
                    FROM
                        " . $this->table_name . " as team
                        INNER JOIN countries as coun
                            ON team.idcountry = coun.id
                        INNER JOIN stadiums as sta
                            ON  team.idstadium = sta.id
                    ORDER BY 
                        team.nickname  ASC
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
