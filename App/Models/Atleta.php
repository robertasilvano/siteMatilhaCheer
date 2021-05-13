<?php

namespace App\Models;

use PDO;
use PDOException;

class Atleta extends \Core\Model {

    public static function getAll() {
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

}

?>