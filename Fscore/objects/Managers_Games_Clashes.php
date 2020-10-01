<?php

class Managers_Games_Clashes {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "managers_games_clashes";
    // Propriedades
    public $id;
    public $idgame_clashe;
    public $idcompetition;
    public $idteam_home;
    public $idteam_away;
    public $idmanager;
    public $type_game_clashe;
    public $punished;
    public $expulsion;
    public $nickname_manager;
    public $photo_manager;
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
                        man_game.id,man_game.idgame_clashe,man_game.idcompetition,man_game.idteam_home, 
                        man_game.idteam_away,man_game.idmanager,man_game.type_game_clashe,man_game.punished,
                        man_game.expulsion,
                        man.nickname as nickname_manager, man.photo_manager
                    FROM
                        " . $this->table_name . " as man_game
                        INNER JOIN managers as man
                            ON man.id = man_game.idmanager
                        ORDER BY man_game.id DESC";
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
                idteam_away=:idteam_away,
                idmanager=:idmanager, 
                type_game_clashe=:type_game_clashe,
                punished=:punished,
                expulsion=:expulsion";
               
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idmanager = filter_var($this->idmanager, FILTER_SANITIZE_NUMBER_INT);
        $this->type_game_clashe = filter_var($this->type_game_clashe, FILTER_SANITIZE_STRING);
        $this->punished =filter_var($this->punished, FILTER_SANITIZE_NUMBER_INT);
        $this->expulsion = filter_var($this->expulsion, FILTER_SANITIZE_NUMBER_INT);
        
        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idmanager", $this->idmanager);
        $stmt->bindValue(":type_game_clashe", $this->type_game_clashe);
        $stmt->bindValue(":punished", $this->punished);
        $stmt->bindValue(":expulsion", $this->expulsion);

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
                        man_game.id,man_game.idgame_clashe,man_game.idcompetition,man_game.idteam_home, 
                        man_game.idteam_away,man_game.idmanager,man_game.type_game_clashe,man_game.punished,
                        man_game.expulsion,
                        man.nickname as nickname_manager, man.photo_manager
                    FROM
                        " . $this->table_name . " as man_game
                        INNER JOIN managers as man
                            ON man.id = man_game.idmanager
                        WHERE
                            man_game.id = :ID
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
        $this->idteam_away = $row['idteam_away'];
        $this->idmanager = $row['idmanager'];
        $this->type_game_clashe = $row['type_game_clashe'];
        $this->punished = $row['punished'];
        $this->expulsion = $row['expulsion'];
        $this->nickname_manager = $row['nickname_manager'];
        $this->photo_manager = $row['photo_manager'];
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
                idgame_clashe=:idgame_clashe,
                idcompetition=:idcompetition,
                idteam_home=:idteam_home,
                idteam_away=:idteam_away,
                idmanager=:idmanager, 
                type_game_clashe=:type_game_clashe,
                punished=:punished,
                expulsion=:expulsion
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idgame_clashe = filter_var($this->idgame_clashe, FILTER_SANITIZE_NUMBER_INT);
        $this->idcompetition = filter_var($this->idcompetition, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_home = filter_var($this->idteam_home, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_away = filter_var($this->idteam_away, FILTER_SANITIZE_NUMBER_INT);
        $this->idmanager = filter_var($this->idmanager, FILTER_SANITIZE_NUMBER_INT);
        $this->type_game_clashe = filter_var($this->type_game_clashe, FILTER_SANITIZE_STRING);
        $this->punished =filter_var($this->punished, FILTER_SANITIZE_NUMBER_INT);
        $this->expulsion = filter_var($this->expulsion, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        
        // Associar valores
        $stmt->bindValue(":idgame_clashe", $this->idgame_clashe);
        $stmt->bindValue(":idcompetition", $this->idcompetition);
        $stmt->bindValue(":idteam_home", $this->idteam_home);
        $stmt->bindValue(":idteam_away", $this->idteam_away);
        $stmt->bindValue(":idmanager", $this->idmanager);
        $stmt->bindValue(":type_game_clashe", $this->type_game_clashe);
        $stmt->bindValue(":punished", $this->punished);
        $stmt->bindValue(":expulsion", $this->expulsion);
        $stmt->bindValue(":id", $this->id);

        // Executar query
        // var_dump($stmt);
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
    function searchByGamesinGameManager($keywords_game,$keywords_type) {
        // Query SQL
        $query = "SELECT                    	
                        man_game.id,man_game.idgame_clashe,man_game.idcompetition,man_game.idteam_home, 
                        man_game.idteam_away,man_game.idmanager,man_game.type_game_clashe,man_game.punished,
                        man_game.expulsion,
                        man.nickname as nickname_manager, man.photo_manager,
                        counP.name as name_country,counP.flag_country
                    FROM
                        " . $this->table_name . " as man_game
                        LEFT JOIN managers as man
                            ON man.id = man_game.idmanager
                        LEFT JOIN countries as counP
                            ON counP.id = man.idcountry
                    WHERE
                        man_game.idgame_clashe LIKE ? AND man_game.type_game_clashe LIKE ?
                    ORDER BY man_game.idmanager DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_game = '%'.filter_var($keywords_game,FILTER_SANITIZE_NUMBER_INT).'%';
        $search_type = '%'.filter_var($keywords_type,FILTER_SANITIZE_STRING).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search_game);
        $stmt->bindValue(2, $search_type);

        // Executar query
        $stmt->execute();

        return $stmt;
    }

    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        man_game.id,man_game.idgame_clashe,man_game.idcompetition,man_game.idteam_home, 
                        man_game.idteam_away,man_game.idmanager,man_game.type_game_clashe,man_game.punished,
                        man_game.expulsion,
                        man.nickname as nickname_manager, man.photo_manager
                    FROM
                        " . $this->table_name . " as man_game
                        INNER JOIN managers as man
                            ON man.id = man_game.idmanager
                    WHERE
                        man_game.nickname LIKE ? OR man_game.id LIKE ? OR man_game.idmanager LIKE ? 
                    ORDER BY man_game.id DESC";

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
                        man_game.id,man_game.idgame_clashe,man_game.idcompetition,man_game.idteam_home, 
                        man_game.idteam_away,man_game.idmanager,man_game.type_game_clashe,man_game.punished,
                        man_game.expulsion,
                        man.nickname as nickname_manager, man.photo_manager
                    FROM
                        " . $this->table_name . " as man_game
                        INNER JOIN managers as man
                            ON man.id = man_game.idmanager
                    WHERE
                        man_game.nickname LIKE ? OR man_game.id LIKE ? OR man_game.idmanager LIKE ? 
                    ORDER BY man_game.id DESC
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

