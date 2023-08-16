<?php

namespace Core\Factories;

use Core\Contracts\ResponseInterface;
use Core\Contracts\ViewInterface;
use Core\View;
use Core\Response;

class ResponseFactory
{

    private string $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function getResponse(): ResponseInterface
    {
        return new Response();
    }

    public function getView(): ViewInterface
    {
        return new View($this->viewPath, $this->getResponse());
    }
}
