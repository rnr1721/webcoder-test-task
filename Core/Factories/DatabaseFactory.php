<?php

namespace Core\Factories;

use Core\Database;

class DatabaseFactory
{
    public function getDatabase()
    {
        $dbConfig = include '../config/db.php';
        return new Database($dbConfig);
    }
}
