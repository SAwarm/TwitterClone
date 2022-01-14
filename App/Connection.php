<?php

namespace App;

use Exception;
use PDO;

class Connection {

    public static function getDb()
    {
        try {

            $conn = new PDO(
                "mysql:host=localhost;dbname=twitter_clone;charset=utf8",
                "root",
                "",
            );

            return $conn;

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}