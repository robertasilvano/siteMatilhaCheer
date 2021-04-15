<?php 

namespace Core;

use PDO;
use PDOException;
use \App\Config;

abstract class Model {

    protected static function getConexaoBD() {
        static $connDB = null;

        if ($connDB === null) {

            try {
                $dsn = Config::sgbd . ':host=' . Config::host . ';dbname=' . Config::db;
                $connDB = new PDO($dsn, Config::user, Config::pass);
            }
            catch (PDOException $e) {
                echo "conexão com o banco de dados falhou: ". $e->getMessage();
            }
        }

        return $connDB;
    }
}

?>