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
        $select = $this->pdo->query("SELECT * FROM atletas");
        $select = $select->fetchAll(PDO::FETCH_ASSOC);

        return $select;
    }

    public function insert($nome, $user, $pass, $nascimento, $telefone, $convenio, $tipo_sangue, $cpf, $diretoria)
    {
        $insert = $this->pdo->prepare("SELECT id FROM atletas WHERE user = :u");
        $insert->bindValue(":u", $user);
        $insert->execute();

        if ($insert->rowCount() > 0) {
            return False;
        }
        else {
            $insert = $this->pdo->prepare("INSERT INTO atletas (nome, user, pass, nascimento, telefone, convenio, tipo_sangue, cpf, diretoria) VALUES (:nome, :user, :pass, :nascimento, :telefone, :convenio, :tipo_sangue, :cpf, :diretoria)");
            
            $insert->bindValue(":nome", $nome);
            $insert->bindValue(":user", $user);
            $insert->bindValue(":pass", $pass);
            $insert->bindValue(":nascimento", $nascimento);
            $insert->bindValue(":telefone", $telefone);
            $insert->bindValue(":convenio", $convenio);
            $insert->bindValue(":tipo_sangue", $tipo_sangue);
            $insert->bindValue(":cpf", $cpf);
            $insert->bindValue(":diretoria", $diretoria);

            $insert->execute();

            return True;
        }
    }

    public function delete($id) {
        $delete = $this->pdo->prepare("DELETE FROM atletas WHERE id = :id");

        $delete->bindValue(":id", $id);

        $delete->execute();
    }

    public function select_id($id) {
        $select_id = $this->pdo->prepare("SELECT * FROM atletas WHERE id = :id");

        $select_id->bindValue(":id", $id);
        $select_id->execute();
        $select_id = $select_id->fetch(PDO::FETCH_ASSOC);

        return $select_id;
    }

    public function update($id) {

    }
}


?>