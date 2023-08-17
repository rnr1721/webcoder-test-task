<?php

namespace Core\Contracts;

/**
 * Any controller must implement this interface
 */
interface Controller
{
    /**
     * 
     * @param array $params Params from URL
     * @return ResponseInterface
     */
    public function run(array $params = []) : ResponseInterface;
}
