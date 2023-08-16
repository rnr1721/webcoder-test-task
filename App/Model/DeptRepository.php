<?php

namespace App\Model;

use Core\Database;

class DeptRepository
{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->getRows('SELECT * FROM depts');
    }
}
