<?php

class Managers_Matchs_Results {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "managers_matchs_results";
    // Propriedades 
    public $id;
    public $idmatch_result;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $idteam_away;
    public $idmanager;
    public $type_match_result;
    public $yellow_card;
    public $red_card;
    public $minutes_yellow;
    public $minutes_red;
    public $rating_points;
    public $nickname_manager;
    public $photo_manager;
    
    
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
                        man_match.id,man_match.idmatch_result,man_match.idgame_clashe,man_match.idcompetition,man_match.idteam_home,
                        man_match.idteam_away,man_match.idmanager,man_match.type_match_result,man_match.yellow_card,man_match.red_card,
                        man_match.minutes_yellow,man_match.minutes_red,man_match.rating_points,
                        man.nickname as nickname_manager, man.photo_manager
                    FROM
                        ". $this->table_name ." as man_match
                        INNER JOIN managers as man
                            ON man.id = man_match.idmanager
                        ORDER BY man_match.id DESC";
    
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
                idteam_away=:idteam_away,
                idmanager=:idmanager, 
                type_match_result=:type_match_result,
                yellow_card=:yellow_card,
                red_card=:red_card,
                minutes_yellow=:minutes_yellow,
                minutes_red=:minutes_red, 
                rating_points=:rating_points";
                
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idmanager = filter_var($this->idmanager, FILTER_SANITIZE_NUMBER_INT);
        $this->type_match_result =filter_var($this->type_match_result, FILTER_SANITIZE_STRING);
        $this->yellow_card = filter_var($this->yellow_card, FILTER_SANITIZE_NUMBER_INT);
        $this->red_card = filter_var($this->red_card, FILTER_SANITIZE_NUMBER_INT);
        $this->minutes_yellow = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->minutes_red = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->rating_points = (float)filter_var($this->minutes_red, FILTER_SANITIZE_NUMBER_FLOAT, 
        FILTER_FLAG_ALLOW_FRACTION);
        

        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idmanager", $this->idmanager);
        $stmt->bindValue(":type_match_result", $this->type_match_result);
        $stmt->bindValue(":yellow_card", $this->yellow_card);
        $stmt->bindValue(":red_card", $this->red_card);
        $stmt->bindValue(":minutes_yellow", $this->minutes_yellow);
        $stmt->bindValue(":minutes_red", $this->minutes_red);
        $stmt->bindValue(":rating_points", $this->rating_points);

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
                    man_match.id,man_match.idmatch_result,man_match.idgame_clashe,man_match.idcompetition,man_match.idteam_home,
                    man_match.idteam_away,man_match.idmanager,man_match.type_match_result,man_match.yellow_card,man_match.red_card,
                    man_match.minutes_yellow,man_match.minutes_red,man_match.rating_points,
                    man.nickname as nickname_manager, man.photo_manager
                FROM
                    ". $this->table_name ." as man_match
                    INNER JOIN managers as man
                        ON man.id = man_match.idmanager
                    WHERE
                        man_match.id = :ID
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
        $this->idteam_away = $row['idteam_away'];
        $this->idmanager = $row['idmanager'];
        $this->type_match_result = $row['type_match_result'];
        $this->yellow_card = $row['yellow_card'];
        $this->red_card = $row['red_card'];
        $this->minutes_yellow = $row['minutes_yellow'];
        $this->minutes_red = $row['minutes_red'];
        $this->rating_points = $row['rating_points'];
        $this->nickname_manager = $row['nickname_manager'];
        $this->photo_manager = $row['photo_manager'];
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
                idteam_away=:idteam_away,
                idmanager=:idmanager, 
                type_match_result=:type_match_result,
                yellow_card=:yellow_card,
                red_card=:red_card,
                minutes_yellow=:minutes_yellow,
                minutes_red=:minutes_red, 
                rating_points=:rating_points
            WHERE
            id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idmatch_result = filter_var($this->idmatch_result, FILTER_SANITIZE_NUMBER_INT);
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idmanager = filter_var($this->idmanager, FILTER_SANITIZE_NUMBER_INT);
        $this->type_match_result =filter_var($this->type_match_result, FILTER_SANITIZE_STRING);
        $this->yellow_card = filter_var($this->yellow_card, FILTER_SANITIZE_NUMBER_INT);
        $this->red_card = filter_var($this->red_card, FILTER_SANITIZE_NUMBER_INT);
        $this->minutes_yellow = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->minutes_red = filter_var($this->minutes_yellow, FILTER_SANITIZE_STRING);
        $this->rating_points = (float)filter_var($this->minutes_red, FILTER_SANITIZE_NUMBER_FLOAT, 
        FILTER_FLAG_ALLOW_FRACTION);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);


        // Associar valores
        $stmt->bindValue(":idmatch_result", $this->idmatch_result);
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idmanager", $this->idmanager);
        $stmt->bindValue(":type_match_result", $this->type_match_result);
        $stmt->bindValue(":yellow_card", $this->yellow_card);
        $stmt->bindValue(":red_card", $this->red_card);
        $stmt->bindValue(":minutes_yellow", $this->minutes_yellow);
        $stmt->bindValue(":minutes_red", $this->minutes_red);
        $stmt->bindValue(":rating_points", $this->rating_points);
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
                    man_match.id,man_match.idmatch_result,man_match.idgame_clashe,man_match.idcompetition,man_match.idteam_home,
                    man_match.idteam_away,man_match.idmanager,man_match.type_match_result,man_match.yellow_card,man_match.red_card,
                    man_match.minutes_yellow,man_match.minutes_red,man_match.rating_points,
                    man.nickname as nickname_manager, man.photo_manager
                FROM
                    ". $this->table_name ." as man_match
                    INNER JOIN managers as man
                        ON man.id = man_match.idmanager
                    WHERE
                    man_match.id LIKE ? OR man_match.idmanager LIKE ? OR man.nickname LIKE ?  
                    ORDER BY man_match.id DESC";

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
                    man_match.id,man_match.idmatch_result,man_match.idgame_clashe,man_match.idcompetition,man_match.idteam_home,
                    man_match.idteam_away,man_match.idmanager,man_match.type_match_result,man_match.yellow_card,man_match.red_card,
                    man_match.minutes_yellow,man_match.minutes_red,man_match.rating_points,
                    man.nickname as nickname_manager, man.photo_manager
                FROM
                    ". $this->table_name ." as man_match
                    INNER JOIN managers as man
                        ON man.id = man_match.idmanager
                    ORDER BY man_match.id DESC
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

