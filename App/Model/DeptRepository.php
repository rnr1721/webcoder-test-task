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

    public function delete(string $deptId): void
    {
        $this->db->deleteRowById('depts', $deptId);
        $this->db->deleteRowsByField('users', 'dept_id', $deptId);
    }
}
