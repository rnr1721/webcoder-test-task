<?php

namespace Core\Contracts;

/**
 * Database operations interface.
 * Implementations must create base CRUD DB operations
 */
interface DatabaseInterface
{

    /**
     * Simple SELECT query
     * 
     * @param string $query SQL query
     * @return array
     */
    public function getRows(string $query): array;

    /**
     * Get one ow by any field
     * 
     * @param int $idValue ID value
     * @param string $table
     * @param string $by Field for query
     * @return array|null
     */
    public function getRowBy(int $idValue, string $table, string $by = 'id'): array|null;

    /**
     * Get one row by ID
     * 
     * @param int $id
     * @param string $table
     * @return array|null
     */
    public function getRowById(int $id, string $table): array|null;

    /**
     * Insert specyfic fields from array as record
     * 
     * @param string $table
     * @param array $data
     * @param array $fields
     * @return bool
     */
    public function insertRow(string $table, array $data, array $fields): bool;

    /**
     * Update row (specyfic data)
     * 
     * @param string $table
     * @param array $data
     * @param array $fields
     * @param int $id
     * @return bool
     */
    public function updateRow(string $table, array $data, array $fields, int $id): bool;

    /**
     * Delete one row by it ID
     * 
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function deleteRowById(string $table, int $id): bool;

    /**
     * Delete all rows by some value
     * 
     * @param string $table
     * @param string $fieldName
     * @param string $fieldValue
     * @return bool
     */
    public function deleteRowsByField(string $table, string $fieldName, string $fieldValue): bool;
}
