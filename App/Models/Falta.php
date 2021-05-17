<?php

namespace App\Models;

use PDO;
use PDOException;
use \App\Auth;

class Falta extends \Core\Model {

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function trataArquivo() {

        if ($_FILES["arquivo"]["tmp_name"]) {

            $diretorio = "uploads/";
            $this->arquivo = $diretorio . basename($_FILES["arquivo"]["name"]);
            $uploadOK = 0;

            $ext = strtolower(pathinfo($this->arquivo, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["arquivo"]["tmp_name"]);

            if ($check !== false) {
                echo "Arquivo recebido: " . $check["mime"] . '<br>';
                $uploadOK = 1;
            }
            else {
                echo "arquivo não encontrado!<br>";
                $uploadOK = 0;
            }

            if(file_exists($this->arquivo)) {
                echo "Arquivo já existente na pasta do servidor. Mude o nome do arquivo e tente novamente!<br>";
                $uploadOK = 0;
            }

            if($_FILES["arquivo"]["size"] > 50000000) {
                echo "Arquivo muito grande! Tente novamente. <br>";
                $uploadOK = 0;
            }

            if ($uploadOK == 1) {
                if(move_uploaded_file($_FILES["arquivo"]["tmp_name"], $this->arquivo)) {
                    echo "Arquivo carregado com sucesso!";
                    $uploadOK = 1;

                }
                else {
                    echo "Erro ao mover o arquivo! Tente novamente.";
                    $uploadOK = 0;
                }
                return $uploadOK;
            }
        }
        else {
            $this->arquivo = 'NULL';
            $uploadOK = 1;
            return $uploadOK;
        }
    }

    public static function selectAll() {
        try {
            $db = static::getConexaoBD();

            $stmt = $db->query('SELECT * FROM faltas');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert() {

        
        $sql = 'INSERT INTO faltas (id_atleta, data, justificativa, arquivo) VALUES (:id_atleta, :data, :justificativa, :arquivo)';
        
        $db = static::getConexaoBD();
        
        $smtm = $db->prepare($sql);
        
        $smtm->bindValue(':id_atleta', $_SESSION['user_id'], PDO::PARAM_STR);
        $smtm->bindValue(':data', $this->data, PDO::PARAM_STR);
        $smtm->bindValue(':justificativa', $this->justificativa, PDO::PARAM_STR);
        $smtm->bindValue(':arquivo', $this->arquivo, PDO::PARAM_STR);

        $smtm->execute();
    }
    
    public static function findByUser($user) {
        
        $sql = 'SELECT * FROM atletas WHERE user = :user';

        $db = static::getConexaoBD();
        $smtm = $db->prepare($sql);
        $smtm->bindParam(':user', $user, PDO::PARAM_STR);

        $smtm->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $smtm->execute();

        return $smtm->fetch(); 
    }

    public static function findByID($id) {
        
        $sql = 'SELECT * FROM atletas WHERE id = :id';

        $db = static::getConexaoBD();
        $smtm = $db->prepare($sql);
        $smtm->bindParam(':id', $id, PDO::PARAM_INT);

        $smtm->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $smtm->execute();

        return $smtm->fetch(); 
    }

    public static function autenticar($user, $pass) {
        $usuario = static::findByUser($user);

        if ($usuario) {
            if (password_verify($pass, $usuario->pass)) {
                return $usuario;
            }
        }
        return false;
    }

    public function validateUpdate($user) {

        //trata a diretoria
        if (isset($user->diretoria)) {
            $user->diretoria = 1;
        }
        else {
            $user->diretoria = 0;
        }

        //trata user
        if ($user->user != $this->user) {
            if (static::findByUser($user->user)) {
                $user->errors[] = 'User já em uso';
            }
        }

    }

    public function update($user) {

        $this->validateUpdate($user);

        $user_atual = Auth::getUserByID($user->id);

        var_dump($user);
        var_dump($user_atual);
        
        if (empty($user->errors)) {

            if(isset($user->pass)) {            
                $sql = 'UPDATE atletas set nome=:nome, user=:user, pass=:pass, nascimento=:nascimento, telefone=:telefone, convenio=:convenio, tipo_sangue=:tipo_sangue, cpf=:cpf, diretoria=:diretoria WHERE id=:id';
            }
            else {
                $sql = 'UPDATE atletas set nome=:nome, user=:user, nascimento=:nascimento, telefone=:telefone, convenio=:convenio, tipo_sangue=:tipo_sangue, cpf=:cpf, diretoria=:diretoria WHERE id=:id';
            }
            
            $db = static::getConexaoBD();
            
            $smtm = $db->prepare($sql);

            $smtm->bindValue(':id', $user->id, PDO::PARAM_INT);
            $smtm->bindValue(':nome', $user->nome, PDO::PARAM_STR);
            $smtm->bindValue(':user', $user->user, PDO::PARAM_STR);
            $smtm->bindValue(':nascimento', $user->nascimento, PDO::PARAM_STR);
            $smtm->bindValue(':telefone', $user->telefone, PDO::PARAM_STR);
            $smtm->bindValue(':convenio', $user->convenio, PDO::PARAM_STR);
            $smtm->bindValue(':tipo_sangue', $user->tipo_sangue, PDO::PARAM_STR);
            $smtm->bindValue(':cpf', $user->cpf, PDO::PARAM_STR);
            $smtm->bindValue(':diretoria', $user->diretoria, PDO::PARAM_STR);

            if(isset($user->pass)) {
                $pass_hash = password_hash($user->pass, PASSWORD_DEFAULT);
                $smtm->bindValue(':pass', $pass_hash, PDO::PARAM_STR);
            }
            
            return $smtm->execute();

        }

        return false;
    }

    public function delete($user_atual) {

        $sql = 'DELETE FROM atletas WHERE id=:id';
            
        $db = static::getConexaoBD();
            
        $smtm = $db->prepare($sql);

        $smtm->bindValue(':id', $user_atual->id, PDO::PARAM_INT);
            
        return $smtm->execute();
    }
}

?>