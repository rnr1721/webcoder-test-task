<?php

namespace Core;

use Core\Contracts\ResponseInterface;

class Response implements ResponseInterface
{

    private array $headers = [];
    private string $body = '';
    private int $responseCode = 200;

    public function setHeader(string $header, string $value): void
    {
        $this->headers[$header] = $value;
    }

    public function setHeaders(array $headers): void
    {
        foreach ($headers as $headerName => $headerValue) {
            $this->setHeader($headerName, $headerValue);
        }
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setResponseCode(int $code = 200): void
    {
        $this->responseCode = $code;
    }

    public function emit(): void
    {

        // Response with code
        http_response_code($this->responseCode);

        // Send headers
        foreach ($this->headers as $headerName => $headerValue) {
            header($headerName . ': ' . $headerValue);
        }

        // Send body
        echo $this->body;
    }

    public function redirect(string $url, int $code = 301): void
    {
        $this->setResponseCode($code);
        header('Location: ' . $url);
        $this->emit();
        exit;
    }
}
