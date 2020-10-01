<?php

class Players_Transfers {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "players_transfers";
    // Propriedades
    public $id;
    public $idplayer;
    public $idtransfer;
    public $idteam_out;
    public $idteam_entry;
    public $contract_date;
    public $valor_actual;
    public $number_shirt;
    public $nickname_player;
    public $photo_player;
    public $idcountry;
    public $nickname_team_entry;
    public $logo_team_entry;
    public $idcountry_team_entry;
    public $nickname_team_out;
    public $logo_team_out;
    public $idcountry_team_out;
    public $name_country_player;
    public $flag_country_player;
    public $name_country_team_entry;
    public $flag_country_team_entry;
    public $name_country_team_out;
    public $flag_country_team_out;
    public $date_transfer;
    public $transfer_type;
    public $valor_transfer;
    public $season;
  
    
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
                        play_transf.id,play_transf.idplayer, play_transf.idtransfer, play_transf.idteam_out, play_transf.idteam_entry,
                        play_transf.contract_date,play_transf.valor_actual, play_transf.number_shirt,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry,teamE.idcountry as idcountry_team_entry,
                        teamO.nickname as nickname_team_out, teamO.logo_team as logo_team_out,teamO.idcountry as idcountry_team_out,
                        counP.name as name_country_player, counP.flag_country as flag_country_player,
                        counE.name as name_country_team_entry, counE.flag_country as flag_country_team_entry,
                        counO.name as name_country_team_out, counO.flag_country as flag_country_team_out,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season
                    FROM
                        " . $this->table_name . " as play_transf
                        INNER JOIN players as play
                            ON play.id = play_transf.idplayer
                        INNER JOIN teams as teamE
                            ON teamE.id = play_transf.idteam_entry
                        INNER JOIN teams as teamO
                            ON teamO.id = play_transf.idteam_out
                        INNER JOIN countries as counP
                            ON counP.id = play.idcountry
                        INNER JOIN countries as counE
                            ON counE.id = teamE.idcountry
                        INNER JOIN countries as counO
                            ON counO.id = teamO.idcountry
                        INNER JOIN transfers as transf
                            ON transf.id = play_transf.idtransfer
                    ORDER BY transf.date_transfer DESC";
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
                idplayer=:idplayer, 
                idtransfer=:idtransfer,
                idteam_out=:idteam_out, 
                idteam_entry=:idteam_entry,
                contract_date=:contract_date,
                valor_actual=:valor_actual, 
                number_shirt=:number_shirt";
                
        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->idtransfer = filter_var($this->idtransfer, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_out = filter_var($this->idteam_out, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_entry = filter_var($this->idteam_entry, FILTER_SANITIZE_NUMBER_INT);
        $this->contract_date = filter_var($this->contract_date, FILTER_SANITIZE_STRING);
        $this->valor_actual = (float)filter_var($this->valor_actual, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->number_shirt =filter_var($this->number_shirt, FILTER_SANITIZE_NUMBER_INT);
        

        // Associar valores
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":idtransfer", $this->idtransfer);
        $stmt->bindValue(":idteam_out", $this->idteam_out);
        $stmt->bindValue(":idteam_entry", $this->idteam_entry);
        $stmt->bindValue(":contract_date", $this->contract_date);
        $stmt->bindValue(":valor_actual", $this->valor_actual);
        $stmt->bindValue(":number_shirt", $this->number_shirt);

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
                        play_transf.id,play_transf.idplayer, play_transf.idtransfer, play_transf.idteam_out, play_transf.idteam_entry,
                        play_transf.contract_date,play_transf.valor_actual, play_transf.number_shirt,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry,teamE.idcountry as idcountry_team_entry,
                        teamO.nickname as nickname_team_out, teamO.logo_team as logo_team_out,teamO.idcountry as idcountry_team_out,
                        counP.name as name_country_player, counP.flag_country as flag_country_player,
                        counE.name as name_country_team_entry, counE.flag_country as flag_country_team_entry,
                        counO.name as name_country_team_out, counO.flag_country as flag_country_team_out,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season
                    FROM
                        " . $this->table_name . " as play_transf
                        INNER JOIN players as play
                            ON play.id = play_transf.idplayer
                        INNER JOIN teams as teamE
                            ON teamE.id = play_transf.idteam_entry
                        INNER JOIN teams as teamO
                            ON teamO.id = play_transf.idteam_out
                        INNER JOIN countries as counP
                            ON counP.id = play.idcountry
                        INNER JOIN countries as counE
                            ON counE.id = teamE.idcountry
                        INNER JOIN countries as counO
                            ON counO.id = teamO.idcountry
                        INNER JOIN transfers as transf
                            ON transf.id = play_transf.idtransfer
                    WHERE
                        play_transf.id = :ID
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
        $this->idplayer = $row['idplayer'];
        $this->idtransfer = $row['idtransfer'];
        $this->idteam_out = $row['idteam_out'];
        $this->idteam_entry = $row['idteam_entry'];
        $this->contract_date = $row['contract_date'];
        $this->valor_actual = $row['valor_actual'];
        $this->number_shirt = $row['number_shirt'];
        $this->nickname_player = $row['nickname_player'];
        $this->photo_player = $row['photo_player'];
        $this->idcountry = $row['idcountry'];
        $this->nickname_team_entry = $row['nickname_team_entry'];
        $this->logo_team_entry = $row['logo_team_entry'];
        $this->idcountry_team_entry = $row['idcountry_team_entry'];
        $this->nickname_team_out = $row['nickname_team_out'];
        $this->logo_team_out = $row['logo_team_out'];
        $this->idcountry_team_out = $row['idcountry_team_out'];
        $this->name_country_player = $row['name_country_player'];
        $this->flag_country_player = $row['flag_country_player'];
        $this->name_country_team_entry = $row['name_country_team_entry'];
        $this->flag_country_team_entry = $row['flag_country_team_entry'];
        $this->name_country_team_out = $row['name_country_team_out'];
        $this->flag_country_team_out = $row['flag_country_team_out'];
        $this->date_transfer = $row['date_transfer'];
        $this->transfer_type = $row['transfer_type'];
        $this->valor_transfer = $row['valor_transfer'];
        $this->season = $row['season'];
        
       
           
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
                idteam_out=:idteam_out, 
                idteam_entry=:idteam_entry,
                contract_date=:contract_date,
                valor_actual=:valor_actual, 
                number_shirt=:number_shirt
            WHERE
            idplayer = :idplayer and idtransfer = :idtransfer";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->idplayer = filter_var($this->idplayer, FILTER_SANITIZE_NUMBER_INT);
        $this->idtransfer = filter_var($this->idtransfer, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_out = filter_var($this->idteam_out, FILTER_SANITIZE_NUMBER_INT);
        $this->idteam_entry = filter_var($this->idteam_entry, FILTER_SANITIZE_NUMBER_INT);
        $this->contract_date = filter_var($this->contract_date, FILTER_SANITIZE_STRING);
        $this->valor_actual = (float)filter_var($this->valor_actual, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->number_shirt =filter_var($this->number_shirt, FILTER_SANITIZE_NUMBER_INT);
        $this->id =filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores 
        $stmt->bindValue(":idplayer", $this->idplayer);
        $stmt->bindValue(":idtransfer", $this->idtransfer);
        $stmt->bindValue(":idteam_out", $this->idteam_out);
        $stmt->bindValue(":idteam_entry", $this->idteam_entry);
        $stmt->bindValue(":contract_date", $this->contract_date);
        $stmt->bindValue(":valor_actual", $this->valor_actual);
        $stmt->bindValue(":number_shirt", $this->number_shirt);
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
                        play_transf.idplayer, play_transf.idtransfer, play_transf.idteam_out, play_transf.idteam_entry,
                        play_transf.contract_date,play_transf.valor_actual, play_transf.number_shirt,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry,teamE.idcountry as idcountry_team_entry,
                        teamO.nickname as nickname_team_out, teamO.logo_team as logo_team_out,teamO.idcountry as idcountry_team_out,
                        counP.name as name_country_player, counP.flag_country as flag_country_player,
                        counE.name as name_country_team_entry, counE.flag_country as flag_country_team_entry,
                        counO.name as name_country_team_out, counO.flag_country as flag_country_team_out,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season
                    FROM
                        " . $this->table_name . " as play_transf
                        INNER JOIN players as play
                            ON play.id = play_transf.idplayer
                        INNER JOIN teams as teamE
                            ON teamE.id = play_transf.idteam_entry
                        INNER JOIN teams as teamO
                            ON teamO.id = play_transf.idteam_out
                        INNER JOIN countries as counP
                            ON counP.id = play.idcountry
                        INNER JOIN countries as counE
                            ON counE.id = teamE.idcountry
                        INNER JOIN countries as counO
                            ON counO.id = teamO.idcountry
                        INNER JOIN transfers as transf
                            ON transf.id = play_transf.idtransfer
                    WHERE
                    play_transf.idplayer LIKE ?
                    ORDER BY transf.date_transfer DESC";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar palavras de pesquisa
        $search = '%'.filter_var($keywords,FILTER_SANITIZE_NUMBER_INT).'%';

        // Atribuir valores 
        $stmt->bindValue(1, $search);
        $stmt->bindValue(2, $search);
        $stmt->bindValue(3, $search);
        $stmt->bindValue(4, $search);
        $stmt->bindValue(5, $search);

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
                        play_transf.idplayer, play_transf.idtransfer, play_transf.idteam_out, play_transf.idteam_entry,
                        play_transf.contract_date,play_transf.valor_actual, play_transf.number_shirt,
                        play.nickname as nickname_player, play.photo_player,play.idcountry,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry,teamE.idcountry as idcountry_team_entry,
                        teamO.nickname as nickname_team_out, teamO.logo_team as logo_team_out,teamO.idcountry as idcountry_team_out,
                        counP.name as name_country_player, counP.flag_country as flag_country_player,
                        counE.name as name_country_team_entry, counE.flag_country as flag_country_team_entry,
                        counO.name as name_country_team_out, counO.flag_country as flag_country_team_out,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season
                    FROM
                        " . $this->table_name . " as play_transf
                        INNER JOIN players as play
                            ON play.id = play_transf.idplayer
                        INNER JOIN teams as teamE
                            ON teamE.id = play_transf.idteam_entry
                        INNER JOIN teams as teamO
                            ON teamO.id = play_transf.idteam_out
                        INNER JOIN countries as counP
                            ON counP.id = play.idcountry
                        INNER JOIN countries as counE
                            ON counE.id = teamE.idcountry
                        INNER JOIN countries as counO
                            ON counO.id = teamO.idcountry
                        INNER JOIN transfers as transf
                            ON transf.id = play_transf.idtransfer
                    ORDER BY transf.date_transfer DESC
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

