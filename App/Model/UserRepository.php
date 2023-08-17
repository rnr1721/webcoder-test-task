<?php

namespace App\Model;

use Core\Contracts\DatabaseInterface;
use App\Contracts\UserRepositoryInterface;

/**
 * Class for working with user repository - users CRUD operations
 */
class UserRepository implements UserRepositoryInterface
{

    /**
     * System PDO wrapper object
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
        return $this->db->getRows('SELECT t1.id,t1.username,t1.email,t1.phone,t1.address,t1.comment,t2.name as deptname FROM users as t1 LEFT JOIN depts as t2 ON t1.dept_id = t2.id');
    }

    /**
     * @inheritDoc
     */
    public function getOne(int $userId): array|null
    {
        return $this->db->getRowById($userId, 'users');
    }

    /**
     * @inheritDoc
     */
    public function delete(string $userId): void
    {
        $this->db->deleteRowById('users', intval($userId));
    }

    /**
     * @inheritDoc
     */
    public function update(array $data): bool
    {
        $fields = ['dept_id', 'email', 'username', 'address', 'phone', 'comment'];
        if (isset($data['id'])) {
            $result = $this->db->updateRow(
                    'users',
                    $data,
                    $fields,
                    $data['id']
            );
        } else {
            $result = $this->db->insertRow(
                    'users',
                    $data,
                    $fields
            );
        }
        return $result;
    }
}
