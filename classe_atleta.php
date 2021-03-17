<?php

require_once("ConexaoPDO.php");

class Atleta {

    private $nome;
    private $user;
    private $pass;
    private $nascimento;
    private $telefone;
    private $convenio;
    private $tipo_sangue;
    private $cpf;
    private $diretoria;
    private $conn;
    
    public function __construct() {
        $this->conn = new ConexaoPDO();
    }

    public function select() {
        $select = $this->conn->conectar()->query("SELECT * FROM atletas");
        $select = $select->fetchAll(PDO::FETCH_ASSOC);

        return $select;
    }

    public function select_id($id) {
        $select_id = $this->conn->conectar()->prepare("SELECT * FROM atletas WHERE id = :id");

        $select_id->bindValue(":id", $id);
        $select_id->execute();
        $select_id = $select_id->fetch(PDO::FETCH_ASSOC);

        return $select_id;
    }


    public function insert() {
        
        $insert = $this->conn->conectar()->prepare("INSERT INTO atletas (nome, user, pass, nascimento, telefone, convenio, tipo_sangue, cpf, diretoria) VALUES (:nome, :user, :pass, :nascimento, :telefone, :convenio, :tipo_sangue, :cpf, :diretoria)");
        
        $insert->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $insert->bindParam(":user", $this->user, PDO::PARAM_STR);
        $insert->bindParam(":pass", $this->pass, PDO::PARAM_STR);
        $insert->bindParam(":nascimento", $this->nascimento, PDO::PARAM_STR);
        $insert->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $insert->bindParam(":convenio", $this->convenio, PDO::PARAM_STR);
        $insert->bindParam(":tipo_sangue", $this->tipo_sangue, PDO::PARAM_STR);
        $insert->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
        $insert->bindParam(":diretoria", $this->diretoria, PDO::PARAM_STR);

        if ($insert->execute()) return True;
        else return False;
        
    }

    public function update($id) {
        $update = $this->select_id($id);
        return $update;
    }

    public function delete($id) {
        $delete = $this->conn->conectar()->prepare("DELETE FROM atletas WHERE id = :id");

        $delete->bindParam(":id", $id, PDO::PARAM_STR);

        $delete->execute();

        echo "<script> location.href = 'cadastro.php' </script>";
    }

    public function printar_tabela($select) {
        
        for ($i=0; $i < count($select); $i++) {
            echo "<tr>";
            foreach ($select[$i] as $k => $v) {
                if ($k != 'diretoria') {
                    echo "<td>" . $v . "</td>";
                }
                else {
                    if ($v == 1) {
                        echo "<td> Sim </td>";
                    }
                    else {
                        echo "<td> Não </td>";
                    }
                }
            }
            echo "<td><a class='btn btn-outline-warning btn-sm' href='cadastro.php?id_del=". $select[$i]['id'] . "'>Excluir</a><a class='btn btn-outline-warning btn-sm' href='cadastro.php?id_up=". $select[$i]['id'] . "'>Editar</a></td>";
            echo "</tr>";
        }
    }



    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($n) {
        $this->nome = $n;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser($u) {
        $this->user = $u;
    }
    
    public function getPass() {
        return $this->pass;
    }
    
    public function setPass($pwd) {
        $this->pass = $pwd;
    }
    
    public function getNascimento() {
        return $this->nascimento;
    }
    
    public function setNascimento($nasc) {
        $this->nascimento = $nasc;
    }
    
    public function getTelefone() {
        return $this->telefone;
    }
    
    public function setTelefone($tel) {
        $this->telefone = $tel;
    }

    public function getConvenio() {
        return $this->convenio;
    }
    
    public function setConvenio($conv) {
        $this->convenio = $conv;
    }

    public function getTipoSangue() {
        return $this->tipo_sangue;
    }
    
    public function setTipoSangue($ts) {
        $this->tipo_sangue = $ts;
    }

    public function getCpf() {
        return $this->cpf;
    }
    
    public function setCpf($c) {
        $this->cpf = $c;
    }

    public function getDiretoria() {
        return $this->diretoria;
    }
    
    public function setDiretoria($dir) {
        $this->diretoria = $dir;
    }
        
}