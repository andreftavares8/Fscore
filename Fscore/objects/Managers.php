<?php

class Managers {

    // Ligação à Base de Dados e nome da tabela
    private $conn;
    private $table_name = "managers";
    // Propriedades
    public $id;
    public $name;
    public $nickname;
    public $birth_date;
    public $idcountry;
    public $photo_manager;
    public $favorite_tatic;
    public $contract_date;
    public $valor_actual ;
    public $name_country;
    public $flag_country;
    public $idteam_entry;
    public $date_transfer;
    public $transfer_type;
    public $valor_transfer;
    public $season;
    public $nickname_team_entry;
    public $logo_team_entry;
    public $idtransfer;

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
                        man.id, man.name, man.nickname,man.birth_date, man.idcountry, man.photo_manager,man.favorite_tatic, 
                        man_transf.idtransfer,man_transf.contract_date, man_transf.valor_actual,man_transf.idteam_entry,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season,
                        counM.name as name_country,counM.flag_country,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry
                        
                    FROM
                        managers as man 
                        LEFT JOIN managers_transfers as man_transf
                        ON man_transf.idmanager = man.id
                        LEFT JOIN teams as teamE
                        ON teamE.id = man_transf.idteam_entry
                        INNER JOIN countries as counM
                        ON counM.id = man.idcountry
                        LEFT JOIN transfers as transf
                        ON transf.id = man_transf.idmanager
                    ORDER BY
                        man.nickname ASC";
      
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
                birth_date=:birth_date, 
                photo_manager=:photo_manager, 
                favorite_tatic=:favorite_tatic,
                idcountry=:idcountry";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->nickname =filter_var($this->nickname,FILTER_SANITIZE_STRING);
        $this->birth_date = filter_var($this->birth_date, FILTER_SANITIZE_STRING);
        $this->photo_manager = filter_var($this->photo_manager, FILTER_SANITIZE_STRING);
        $this->favorite_tatic = filter_var($this->favorite_tatic, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);

        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":nickname", $this->nickname);
        $stmt->bindValue(":birth_date", $this->birth_date);
        $stmt->bindValue(":photo_manager", $this->photo_manager);
        $stmt->bindValue(":favorite_tatic", $this->favorite_tatic);
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
                        man.id, man.name, man.nickname,man.birth_date, man.idcountry, man.photo_manager,man.favorite_tatic, 
                        man_transf.idtransfer,man_transf.contract_date, man_transf.valor_actual,man_transf.idteam_entry,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season,
                        counM.name as name_country,counM.flag_country,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry
                        
                    FROM
                        managers as man 
                        INNER JOIN managers_transfers as man_transf
                        ON man_transf.idmanager = man.id
                        INNER JOIN teams as teamE
                        ON teamE.id = man_transf.idteam_entry
                        INNER JOIN countries as counM
                        ON counM.id = man.idcountry
                        INNER JOIN transfers as transf
                        ON transf.id = man_transf.idmanager
                    WHERE
                        man.id = :ID
                    Group by man.id
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
        $this->birth_date = $row['birth_date'];
        $this->idcountry = $row['idcountry'];
        $this->photo_manager = $row['photo_manager'];
        $this->favorite_tatic = $row['favorite_tatic'];
        $this->contract_date = $row['contract_date'];
        $this->valor_actual = $row['valor_actual'];
        $this->name_country = $row['name_country'];
        $this->flag_country = $row['flag_country'];
        $this->idteam_entry = $row['idteam_entry'];
        $this->idtransfer = $row['idtransfer'];
        $this->date_transfer = $row['date_transfer'];
        $this->transfer_type = $row['transfer_type'];
        $this->valor_transfer = $row['valor_transfer'];
        $this->season = $row['season'];
        $this->nickname_team_entry = $row['nickname_team_entry'];
        $this->logo_team_entry = $row['logo_team_entry'];

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
                nickname = :nickname,
                birth_date = :birth_date,
                photo_manager = :photo_manager,
                favorite_tatic = :favorite_tatic,
                idcountry = :idcountry
            WHERE
                id = :id";

        // Preparar query
        $stmt = $this->conn->prepare($query);

        // Filtrar valores
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->nickname = filter_var($this->nickname, FILTER_SANITIZE_STRING);
        $this->birth_date = filter_var($this->birth_date, FILTER_SANITIZE_STRING);
        $this->favorite_tatic = filter_var($this->favorite_tatic, FILTER_SANITIZE_STRING);
        $this->photo_manager = filter_var($this->photo_manager, FILTER_SANITIZE_STRING);
        $this->idcountry = filter_var($this->idcountry, FILTER_SANITIZE_NUMBER_INT);
        $this->id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
       
        // Associar valores
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":nickname", $this->nickname);
        $stmt->bindValue(":birth_date", $this->birth_date);
        $stmt->bindValue(":favorite_tatic", $this->favorite_tatic);
        $stmt->bindValue(":photo_manager", $this->photo_manager);
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
                        man.id, man.name, man.nickname,man.birth_date, man.idcountry, man.photo_manager,man.favorite_tatic, 
                        man_transf.idtransfer,man_transf.contract_date, man_transf.valor_actual,man_transf.idteam_entry,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season,
                        counM.name as name_country,counM.flag_country,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry
                        
                    FROM
                        managers as man 
                        LEFT JOIN managers_transfers as man_transf
                        ON man_transf.idmanager = man.id
                        LEFT JOIN teams as teamE
                        ON teamE.id = man_transf.idteam_entry
                        LEFT JOIN countries as counM
                        ON counM.id = man.idcountry
                        LEFT JOIN transfers as transf
                        ON transf.id = man_transf.idmanager
                    WHERE
                        man.name LIKE ? OR man.nickname LIKE ?
                    GROUP BY man.id
                    ORDER BY man.nickname ASC";

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
                        man.id, man.name, man.nickname,man.birth_date, man.idcountry, man.photo_manager,man.favorite_tatic, 
                        man_transf.idtransfer,man_transf.contract_date, man_transf.valor_actual,man_transf.idteam_entry,
                        transf.date_transfer,transf.transfer_type,transf.valor_transfer,transf.season,
                        counM.name as name_country,counM.flag_country,
                        teamE.nickname as nickname_team_entry, teamE.logo_team as logo_team_entry
                        
                    FROM
                        managers as man 
                        INNER JOIN managers_transfers as man_transf
                        ON man_transf.idmanager = man.id
                        INNER JOIN teams as teamE
                        ON teamE.id = man_transf.idteam_entry
                        INNER JOIN countries as counM
                        ON counM.id = man.idcountry
                        INNER JOIN transfers as transf
                        ON transf.id = man_transf.idmanager
                    GROUP BY man.id
                    ORDER BY
                        man.nickname ASC
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

