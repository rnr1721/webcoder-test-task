<?php

namespace Core\Factories;

use Core\Contracts\ResponseInterface;
use Core\Contracts\ViewInterface;
use Core\View;
use Core\Response;

/**
 * Create ready-for-use View and Response objects
 */
class ResponseFactory
{

    /**
     * Directory with templates
     * 
     * @var string
     */
    private string $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * Create system response object
     * 
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return new Response();
    }

    /**
     * Create View (template engine) with system response object inside
     * 
     * @return ViewInterface
     */
    public function getView(): ViewInterface
    {
        return new View($this->viewPath, $this->getResponse());
    }
}
