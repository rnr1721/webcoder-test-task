<?php

namespace Core\Contracts;

interface Controller
{
    public function run(array $params = []) : ResponseInterface;
}
