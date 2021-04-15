<?php

namespace App\Models;

use PDO;
use PDOException;

class Post extends \Core\Model {

    public static function getAll() {
        try {
            $db = static::getConexaoBD();

            $stmt = $db->query('SELECT id, titulo, conteudo FROM posts ORDER BY criado_em');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>