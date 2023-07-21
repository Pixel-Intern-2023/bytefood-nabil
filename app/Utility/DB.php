<?php

namespace app\Utility;

require_once __DIR__ . "/../Config/Database.php";

use app\Config\Database;
use PDOStatement;

class DB{

    public static function exec(string $query, array $params = []): PDOStatement
    {
        $statement = Database::getConnection()->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    public static function lastInsertId(): string
    {
        $id = null;
        if($r = Database::getConnection()->lastInsertId()){
            $id = $r;
        }

        return $id;
    }

    public static function findById(string $table, int $id)
    {
        $statement = Database::getConnection()->prepare("SELECT * FROM $table WHERE id=?");
        $statement->execute([$id]);

        if($row = $statement->fetch()){
            return $row;
        }
    }
}