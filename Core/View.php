<?php

namespace Core;

use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use InvalidArgumentException;

/**
 * Simple PHP template engine
 */
class View implements ViewInterface
{

    /**
     * Directory with templates
     * 
     * @var string
     */
    private string $templateDir;

    /**
     * System response object
     * 
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    public function __construct(string $templateDir, ResponseInterface $response)
    {
        $this->templateDir = rtrim($templateDir, '/') . '/';
        $this->response = $response;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     */
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
        // Extract template data to use as variables in templates
        extract($data, EXTR_SKIP);
        include $templatePath;
        // Get template as string
        $result = ob_get_clean();

        // Set up response object data
        $this->response->setResponseCode($responseCode);
        $this->response->setBody($result);
        $this->response->setHeaders($headers);
        return $this->response;
    }

    /**
     * @inheritDoc
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
