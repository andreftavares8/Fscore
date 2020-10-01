<?php

class Stadiums {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "stadiums";
    // Propriedades
    public $id;
    public $name;
    public $logo_stadium;
    public $capacity;
    public $city;
    public $foundation;
    public $grass_type;
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
                    sta.id,sta.name,sta.logo_stadium,sta.capacity,sta.city,sta.foundation,
                    sta.grass_type,sta.idcountry,
                    coun.name as name_country,coun.flag_country
                FROM
                    " . $this->table_name . " as sta
                    INNER JOIN 
                        countries as coun
                        ON sta.idcountry = coun.id
                ORDER BY 
                    sta.name  ASC";
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
                logo_stadium=:logo_stadium, 
                capacity=:capacity,
                city=:city,
                foundation=:foundation, 
                grass_type=:grass_type,
                idcountry=:idcountry";
            
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->logo_stadium = filter_var ($this->logo_stadium,FILTER_SANITIZE_STRING);
        $this->capacity = filter_var($this->capacity, FILTER_SANITIZE_NUMBER_INT);
        $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
        $this->foundation = filter_var($this->foundation,FILTER_SANITIZE_STRING);
        $this->grass_type = filter_var($this->grass_type, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":logo_stadium", $this->logo_stadium);
        $stmt->bindValue(":capacity", $this->capacity);
        $stmt->bindValue(":city", $this->city);
        $stmt->bindValue(":foundation", $this->foundation);
        $stmt->bindValue(":grass_type", $this->grass_type);
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
                        sta.id,sta.name,sta.logo_stadium,sta.capacity,sta.city,sta.foundation,
                        sta.grass_type,sta.idcountry,
                        coun.name as name_country,coun.flag_country
                    FROM
                        " . $this->table_name . " as sta
                        INNER JOIN 
                            countries as coun
                            ON sta.idcountry = coun.id
                    WHERE 
                        sta.id = :ID
                    LIMIT 0,1";
 
        $stmt = $this->conn->prepare($query);
        // Filtrar e associar valor do ID
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $stmt->bindValue(':ID', $this->id);

        // Executar query
        $stmt->execute();
        
        // Obter dados do registo e instanciar o objeto
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_sta = $row['id'];
        $this->name = $row['name'];
        $this->logo_stadium = $row['logo_stadium'];
        $this->capacity = $row['capacity'];
        $this->city = $row['city'];
        $this->foundation = $row['foundation'];
        $this->grass_type = $row['grass_type'];
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
                name=:name,
                logo_stadium=:logo_stadium, 
                capacity=:capacity,
                city=:city,
                foundation=:foundation, 
                grass_type=:grass_type,
                idcountry=:idcountry
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->logo_stadium = filter_var ($this->logo_stadium,FILTER_SANITIZE_STRING);
        $this->capacity = filter_var($this->capacity, FILTER_SANITIZE_NUMBER_INT);
        $this->city = filter_var($this->city, FILTER_SANITIZE_STRING);
        $this->foundation = filter_var($this->foundation,FILTER_SANITIZE_STRING);
        $this->grass_type = filter_var($this->grass_type, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":logo_stadium", $this->logo_stadium);
        $stmt->bindValue(":capacity", $this->capacity);
        $stmt->bindValue(":city", $this->city);
        $stmt->bindValue(":foundation", $this->foundation);
        $stmt->bindValue(":grass_type", $this->grass_type);
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
    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        sta.id,sta.name,sta.logo_stadium,sta.capacity,sta.city,sta.foundation,
                        sta.grass_type,sta.idcountry,
                        coun.name as name_country,coun.flag_country
                    FROM
                        " . $this->table_name . " as sta
                        INNER JOIN 
                            countries as coun
                            ON sta.idcountry = coun.id
                    WHERE
                        sta.id LIKE ?
                    ORDER BY
                        sta.id ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
       $stmt->bindValue(1,$search);

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
                        sta.id,sta.name,sta.logo_stadium,sta.capacity,sta.city,sta.foundation,
                        sta.grass_type,sta.idcountry,
                        coun.name as name_country,coun.flag_country
                    FROM
                        " . $this->table_name . " as sta
                        INNER JOIN 
                            countries as coun
                            ON sta.idcountry = coun.id
                    ORDER BY
                        sta.name ASC
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
