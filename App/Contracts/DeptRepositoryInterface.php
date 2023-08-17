<?php

namespace App\Contracts;

interface DeptRepositoryInterface
{
    public function getAll(): array;
    public function delete(string $deptId): void;
    public function update(array $data): bool;
}
