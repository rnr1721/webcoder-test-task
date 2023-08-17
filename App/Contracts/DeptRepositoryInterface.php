<?php

namespace App\Contracts;

/**
 * Departments repository object.
 * It can get all records, delete record and update records
 */
interface DeptRepositoryInterface
{

    /**
     * Get all departments (SELECT *)
     * 
     * @return array
     */
    public function getAll(): array;

    /**
     * Delete one record by it ID
     * 
     * @param string $deptId ID
     * @return void
     */
    public function delete(string $deptId): void;

    /**
     * Create or update record.
     * If "id" key present, it will create new record,
     * otherwise - it record with some ID will be updated
     * 
     * @param array $data Record data
     * @return bool
     */
    public function update(array $data): bool;
}
