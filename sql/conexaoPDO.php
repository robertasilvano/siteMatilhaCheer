<?php

class ConexaoPDO {

    // Atributos da classe para conexão com o BD
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private static $conn;
    
    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "avii_desenvweb";
    }
    
    public function conectar() {
        try {
            if (is_null(self::$conn)) {
                self::$conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            }
            return self::$conn;
        } catch(PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
            exit();
        }
    }

}

?>
