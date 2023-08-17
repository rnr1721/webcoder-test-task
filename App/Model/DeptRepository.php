<?php

namespace App\Model;

use Core\Contracts\DatabaseInterface;
use App\Contracts\DeptRepositoryInterface;

/**
 * Work with departments repository data
 */
class DeptRepository implements DeptRepositoryInterface
{

    /**
     * Database PDO wrapper object
     * 
     * @var DatabaseInterface
     */
    private DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->db->getRows('SELECT * FROM depts');
    }

    /**
     * @inheritDoc
     */
    public function delete(string $deptId): void
    {
        $this->db->deleteRowById('depts', $deptId);
        $this->db->deleteRowsByField('users', 'dept_id', $deptId);
    }

    /**
     * @inheritDoc
     */
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
