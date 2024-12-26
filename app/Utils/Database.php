<?php

namespace App\Utils;

use PDO;

class Database
{
    private static $dbh;

    public static function getPDO()
    {
        if (self::$dbh === null) {
            $dsn = 'mysql:host=' . CONFIG['database']['DB_HOST'] . ';dbname=' . CONFIG['database']['DB_NAME'] . ';charset=utf8;port=' . CONFIG['database']['DB_PORT'];
            self::$dbh = new PDO($dsn, CONFIG['database']['DB_USER'], CONFIG['database']['DB_PASSWORD'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$dbh;
    }
}
