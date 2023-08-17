<?php

namespace Core\Factories;

use Core\Database;
use Core\Contracts\DatabaseInterface;

/**
 * Create ready-for-use database
 */
class DatabaseFactory
{

    /**
     * Get configured database object
     * 
     * @return DatabaseInterface
     */
    public function getDatabase(): DatabaseInterface
    {
        $dbConfig = include '../config/db.php';
        return new Database($dbConfig);
    }
}
