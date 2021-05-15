<?php

namespace App\Models;

use PDO;
use PDOException;

class User extends \Core\Model {

    public $errors = [];

    public function __construct($data) {
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

        if (empty($this->errors)) {
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

        $sql = 'SELECT * FROM atletas WHERE user = :user';

        $db = static::getConexaoBD();
        $smtm = $db->prepare($sql);
        $smtm->bindParam(':user', $this->user, PDO::PARAM_STR);

        $smtm->execute();

        if ($smtm->fetch() !== false) {
            $this->errors[] = 'User já em uso';
        }
    }
}

?>