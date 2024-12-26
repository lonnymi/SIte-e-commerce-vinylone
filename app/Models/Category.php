<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category
{
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM categories';
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
