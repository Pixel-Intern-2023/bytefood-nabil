<?php

namespace app\Config;

use PDO;

class Database{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO("mysql:host=localhost:3306;dbname=bytefood", "root", "");
        }

        return self::$pdo;
    }
}