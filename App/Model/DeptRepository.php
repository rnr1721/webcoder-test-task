<?php

namespace App\Model;

use Core\Database;
use App\Contracts\DeptRepositoryInterface;

class DeptRepository implements DeptRepositoryInterface
{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db->getRows('SELECT * FROM depts');
    }

    public function delete(string $deptId): void
    {
        $this->db->deleteRowById('depts', $deptId);
        $this->db->deleteRowsByField('users', 'dept_id', $deptId);
    }

    public function update(array $data): bool
    {
        $result = $this->db->insertRow(
                'depts',
                $data,
                ['name']
        );
        return $result;
    }
}
