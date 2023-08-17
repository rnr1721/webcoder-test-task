<?php

namespace App\Contracts;

interface UserRepositoryInterface
{

    public function getAll(): array;

    public function getOne(int $userId): array|null;

    public function delete(string $userId): void;

    public function update(array $data): bool;
}
