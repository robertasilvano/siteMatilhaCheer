<?php

namespace App\Models;

use PDO;
use PDOException;
use \App\Auth;
use App\Flash;

class User extends \Core\Model {

    public $errors = [];

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function selectAll() {
        try {
            $db = static::getConexaoBD();

            $stmt = $db->query('SELECT * FROM atletas');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert() {

        $this->validate();

        if (!Flash::getMensagens()) {
            $pass_hash = password_hash($this->pass, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO atletas (nome, user, pass, nascimento, telefone, convenio, tipo_sangue, cpf, diretoria) VALUES (:nome, :user, :pass, :nascimento, :telefone, :convenio, :tipo_sangue, :cpf, :diretoria)';

            $db = static::getConexaoBD();

            $smtm = $db->prepare($sql);
            
            $smtm->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $smtm->bindValue(':user', $this->user, PDO::PARAM_STR);
            $smtm->bindValue(':pass', $pass_hash, PDO::PARAM_STR);
            $smtm->bindValue(':nascimento', $this->nascimento, PDO::PARAM_STR);
            $smtm->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
            $smtm->bindValue(':convenio', $this->convenio, PDO::PARAM_STR);
            $smtm->bindValue(':tipo_sangue', $this->tipo_sangue, PDO::PARAM_STR);
            $smtm->bindValue(':cpf', $this->cpf, PDO::PARAM_STR);
            $smtm->bindValue(':diretoria', $this->diretoria, PDO::PARAM_STR);

            return $smtm->execute();
        }

        return false;
    }

    public function validate() {

        //trata a diretoria
        if (isset($this->diretoria)) {
            $this->diretoria = 1;
        }
        else {
            $this->diretoria = 0;
        }

        //trata user
        if (static::findByUser($this->user) !== false) {
            Flash::addMensagens("User já em uso!");
        }

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

        //$user_atual = Auth::getUserByID($user->id);
        
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