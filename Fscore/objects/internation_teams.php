<?php

class Countries {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "internation_teams";
    // Propriedades
    public $id;
    public $idteam;
    public $idplayer;
    public $summoned;
    public $nickname;
    public $photo_player;
    
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
                    inter.id,inter.idteam,inter.idplayer,inter.summoned,
                    play.nickname, play.photo_player
                FROM
                    " . $this->table_name . " as inter
                    INNER JOIN players as play
                        ON play.id = inter.idplayer
                ORDER BY 
                    inter.id DESC";

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
                idplayer=:idplayer,
                summoned=:summoned";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->summoned = filter_var($this->summoned, FILTER_SANITIZE_NUMBER_INT);
        

        // Associar valores
        $stmt->bindValue(":idteam", $this->idteam);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":summoned", $this->summoned);
        

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
                        inter.id,inter.idteam,inter.idplayer,inter.summoned,
                        play.nickname, play.photo_player
                    FROM
                        " . $this->table_name . " as inter
                        INNER JOIN players as play
                            ON play.id = inter.idplayer
                    WHERE
                    inter.id = :ID
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
        $this->idplayer = $row['idplayer'];
        $this->summoned = $row['summoned'];
        $this->nickname = $row['nickname'];
        $this->photo_player = $row['photo_player'];
       
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
                    idplayer = :idplayer,
                    summoned = :summoned
               
                WHERE
                    id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idteam = filter_var($this->idteam, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->summoned = filter_var($this->summoned, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);


        // Associar valores
        $stmt->bindValue(":idteam", $this->idteam);
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":summoned", $this->summoned);
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
                    inter.id,inter.idteam,inter.idplayer,inter.summoned,
                    play.nickname, play.photo_player
                FROM
                    " . $this->table_name . " as inter
                    INNER JOIN players as play
                        ON play.id = inter.idplayer
                
                WHERE
                    inter.id LIKE ? OR inter.idplayer LIKE ?
                ORDER BY 
                    inter.id DESC";

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
                inter.id,inter.idteam,inter.idplayer,inter.summoned,
                play.nickname, play.photo_player
            FROM
                " . $this->table_name . " as inter
                INNER JOIN players as play
                    ON play.id = inter.idplayer
            ORDER BY 
                inter.id DESC
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

