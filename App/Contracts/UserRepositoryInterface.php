<?php

namespace App\Contracts;

/**
 * CRUD operations with users list
 */
interface UserRepositoryInterface
{

    /**
     * Get all users (SELECT *)
     * 
     * @return array
     */
    public function getAll(): array;

    /**
     * Get one user by ID
     * 
     * @param int $userId
     * @return array|null
     */
    public function getOne(int $userId): array|null;

    /**
     * Delete one user by ID
     * 
     * @param string $userId
     * @return void
     */
    public function delete(string $userId): void;

    /**
     * Update one user by array with data.
     * If user id present in data array, it will update user,
     * otherwise, it will create new user
     * 
     * @param array $data User data
     * @return bool
     */
    public function update(array $data): bool;
}
