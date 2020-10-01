<?php

class Favorites_Players {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "favorites_players";
    // Propriedades
    public $id;
    public $iduser;
    public $idplayer;
    public $name_user;
    public $nickname_player;
    public $photo_player;
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
                        fav_play.id,fav_play.iduser, fav_play.idplayer,
                        user.username as name_user,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_play
                        INNER JOIN users as user
                            ON user.id = fav_play.iduser
                        INNER JOIN players as play
                            ON play.id = fav_play.idplayer
                        INNER JOIN countries as coun
                            ON play.idcountry = coun.id  
                    ORDER BY play.nickname ASC";

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
                idplayer=:idplayer";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
       
        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idplayer", $this->idplayer);
       

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
                        fav_play.id,fav_play.iduser, fav_play.idplayer,
                        user.username as name_user,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_play
                        INNER JOIN users as user
                            ON user.id = fav_play.iduser
                        INNER JOIN players as play
                            ON play.id = fav_play.idplayer
                        INNER JOIN countries as coun
                            ON play.idcountry = coun.id  
                    WHERE fav_play.id = :ID
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
        $this->idplayer = $row['idplayer'];
        $this->nickname_player = $row['nickname_player'];
        $this->photo_player = $row['photo_player'];
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
                idplayer = :idplayer
                
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->iduser = filter_var($this->iduser, FILTER_SANITIZE_NUMBER_INT);
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        // Associar valores
        $stmt->bindValue(":iduser", $this->iduser);
        $stmt->bindValue(":idplayer", $this->idplayer);
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
    function searchSegPlay($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        id,iduser, COUNT(idplayer) as seg
                    FROM 
                        " . $this->table_name . "
                        
                    WHERE   idplayer LIKE ?
                    ";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_NUMBER_INT).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search);

        // Executar query
        $stmt->execute();

        return $stmt;
    }
    function searchByUserByPayers($keywords_user,$keywords_play) {
        // Query SQL
        $query = "SELECT                    	
                        fav_play.id,fav_play.iduser, fav_play.idplayer,
                        user.username as name_user,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_play
                        INNER JOIN users as user
                        ON user.id = fav_play.iduser
                    INNER JOIN players as play
                        ON play.id = fav_play.idplayer
                    INNER JOIN countries as coun
                        ON play.idcountry = coun.id 
                    WHERE   fav_play.iduser = ? and fav_play.idplayer = ?
                    ORDER BY play.nickname ASC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search_user = filter_var($keywords_user,FILTER_SANITIZE_NUMBER_INT);
        $search_play = filter_var($keywords_play,FILTER_SANITIZE_NUMBER_INT);
        // Atribuir valores 
        $stmt->bindValue(1, $search_user);
        $stmt->bindValue(2, $search_play);

        // Executar query
        $stmt->execute();

        return $stmt;
    }
    
    function search($keywords) {
        // Query SQL
        $query = "SELECT                    	
                        fav_play.id,fav_play.iduser, fav_play.idplayer,
                        user.username as name_user,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        coun.name as name_country, coun.flag_country,
                        play_transf.idteam_entry,
                        team.nickname as nickname_team, team.logo_team
                    FROM 
                        " . $this->table_name . " as fav_play
                        INNER JOIN users as user
                            ON user.id = fav_play.iduser
                        INNER JOIN players as play
                            ON play.id = fav_play.idplayer
                        INNER JOIN countries as coun
                            ON play.idcountry = coun.id  
                        LEFT JOIN players_transfers as play_transf
                            ON play_transf.idplayer = play.id 
                        LEFT JOIN teams as team
                            ON team.id = play_transf.idteam_entry
                    WHERE  
                        play.nickname LIKE ? OR fav_play.iduser LIKE ?
                    GROUP BY
                        play.id
                    ORDER BY
                        play.nickname ASC";

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
                        fav_play.id,fav_play.iduser, fav_play.idplayer,
                        user.username as name_user,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        coun.name as name_country, coun.flag_country
                    FROM 
                        " . $this->table_name . " as fav_play
                        INNER JOIN users as user
                            ON user.id = fav_play.iduser
                        INNER JOIN players as play
                            ON play.id = fav_play.idplayer
                        INNER JOIN countries as coun
                            ON play.idcountry = coun.id  
                    ORDER BY play.nickname ASC
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