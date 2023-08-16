<?php

namespace Core;

use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use InvalidArgumentException;

class View implements ViewInterface
{

    private string $templateDir;
    private ResponseInterface $response;

    public function __construct(string $templateDir, ResponseInterface $response)
    {
        $this->templateDir = rtrim($templateDir, '/') . '/';
        $this->response = $response;
    }

    public function render(
            string $template,
            array $data = [],
            int $responseCode = 200,
            array $headers = []): ResponseInterface
    {
        $templatePath = $this->templateDir . $template;

        if (!file_exists($templatePath)) {
            throw new InvalidArgumentException("Template '$template' not found.");
        }

        ob_start();
        extract($data, EXTR_SKIP);
        include $templatePath;
        $result = ob_get_clean();

        $this->response->setResponseCode($responseCode);
        $this->response->setBody($result);
        $this->response->setHeaders($headers);
        return $this->response;
    }
    
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
