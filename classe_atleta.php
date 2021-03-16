<?php 

class Atleta{

    private $pdo;

    public function __construct($dbname, $host, $user, $pass)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $pass);           
        }
        catch (PDOException $e) {
            echo "Erro com o banco de dados: ".$e->getMessage();
            exit();
        }
        catch (Exception $e) {
            echo "Erro genérico: ".$e->getMessage();
            exit();
        }
    }

    public function select()
    {
        $stmt = $this->pdo->query("SELECT * FROM atletas");
        $stmt = $stmt->fetch();

        return $stmt;
    }
}


?>