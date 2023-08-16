<?php

namespace Core\Contracts;

interface RouterInterface
{
    public function route(?string $method = null, ?string $uri = null): array;
}
