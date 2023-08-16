<?php

namespace App\Model;

use Core\Contracts\DatabaseInterface;

class UserRepository
{

    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        return $this->db->getRows('SELECT t1.id,t1.username,t1.email,t1.phone,t1.address,t1.comment,t2.name as deptname FROM users as t1 LEFT JOIN depts as t2 ON t1.dept_id = t2.id');
    }

    public function getOne(int $userId): array|null
    {
        return $this->db->getRowById($userId, 'users');
    }

    public function delete(string $userId): void
    {
        $this->db->deleteRowById('users', intval($userId));
    }
}
