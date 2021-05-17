<?php

namespace App\Models;

use App\Auth;
use PDO;
use \App\Flash;

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
                Flash::addMensagens('Arquivo recebido: '. $check["mime"]);
                $uploadOK = 1;
            }
            else {
                Flash::addMensagens('Arquivo não encontrado!');
                $uploadOK = 0;
            }

            if(file_exists($this->arquivo)) {
                Flash::addMensagens('Arquivo já existente na pasta do servidor. Mude o nome do arquivo e tente novamente!');
                $uploadOK = 0;
            }

            if($_FILES["arquivo"]["size"] > 50000000) {
                Flash::addMensagens('Arquivo muito grande!');
                $uploadOK = 0;
            }

            if ($uploadOK == 1) {
                if(move_uploaded_file($_FILES["arquivo"]["tmp_name"], $this->arquivo)) {
                    Flash::addMensagens('Arquivo carregado com sucesso!');
                    $uploadOK = 1;

                }
                else {
                    Flash::addMensagens('Erro ao mover o arquivo! Tente novamente.');
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

    public function deletaArquivo() {

        if ($_FILES["arquivo"]["tmp_name"]) {

            $diretorio = "uploads/";
            $arquivo = $diretorio . basename($_FILES["arquivo"]["name"]);

            if (file_exists($arquivo)) {
                unlink($arquivo);
            }
        }
    }


    public static function selectAllByIDAtleta() {
        $sql = 'SELECT * FROM faltas WHERE id_atleta=:id';

        $db = static::getConexaoBD();

        $smtm = $db->prepare($sql);

        $smtm->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        
        $smtm->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $smtm->execute();

        return $smtm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert() {
        
        $sql = 'INSERT INTO faltas (id_atleta, data, justificativa, arquivo) VALUES (:id_atleta, :data, :justificativa, :arquivo)';
        
        $db = static::getConexaoBD();
        
        $smtm = $db->prepare($sql);
        
        $smtm->bindValue(':id_atleta', $_SESSION['user_id'], PDO::PARAM_STR);
        $smtm->bindValue(':data', $this->data, PDO::PARAM_STR);
        $smtm->bindValue(':justificativa', $this->justificativa, PDO::PARAM_STR);
        $smtm->bindValue(':arquivo', $this->arquivo, PDO::PARAM_STR);

        return $smtm->execute();
    }

    public function update($falta) {
            
        if(isset($falta->arquivo)) {            
            $sql = 'UPDATE faltas set data=:data, justificativa=:justificativa, arquivo=:arquivo WHERE id=:id';
        }
        else {
            $sql = 'UPDATE faltas set data=:data, justificativa=:justificativa WHERE id=:id';
        }

        $db = static::getConexaoBD();
        
        $smtm = $db->prepare($sql);

        $smtm->bindValue(':data', $falta->data, PDO::PARAM_STR);
        $smtm->bindValue(':justificativa', $falta->justificativa, PDO::PARAM_STR);
        $smtm->bindValue(':id', $falta->id, PDO::PARAM_INT);

        if(isset($falta->arquivo)) {
            $smtm->bindValue(':arquivo', $falta->arquivo, PDO::PARAM_STR);
        }

        return $smtm->execute();

    }

    public function delete($falta_atual) {

        $sql = 'DELETE FROM faltas WHERE id=:id';
            
        $db = static::getConexaoBD();
            
        $smtm = $db->prepare($sql);

        $smtm->bindValue(':id', $falta_atual->id, PDO::PARAM_INT);
            
        return $smtm->execute();
    }

    public static function findByID($id) {
        
        $sql = 'SELECT * FROM faltas WHERE id = :id';

        $db = static::getConexaoBD();
        $smtm = $db->prepare($sql);
        $smtm->bindParam(':id', $id, PDO::PARAM_INT);

        $smtm->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $smtm->execute();

        return $smtm->fetch(); 
    }
}

?>