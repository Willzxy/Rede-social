<?php 

namespace App;

class Connection {
    public static function getDb(){
        try {
            
            $conn = new \PDO(
                "mysql:host=localhost;dbname=twitter_db;charset=utf8;",
                "root",
                "root"
            );

            return $conn;
        } catch (\PDOExecption $e) {
            echo "Eroo: " . $e;
        }
    }
}

?>