<?php

namespace Core\Contracts;

interface DatabaseInterface
{

    public function getRows(string $query): array;

    public function getRowBy(int $userId, string $table, string $by = 'id'): array|null;

    public function getRowById(int $userId, string $table): array|null;

    public function insertRow(string $table, array $data, array $fields): bool;

    public function updateRow(string $table, array $data, array $fields, int $id): bool;

    public function deleteRowById(string $table, int $id): bool;
}
