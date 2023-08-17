<?php

namespace Core;

use Core\Contracts\ResponseInterface;

/**
 * Response class.
 * It collects response data for emit.
 * Any controller must return ResponseInterface
 */
class Response implements ResponseInterface
{

    /**
     * Current headers array
     * 
     * @var array
     */
    private array $headers = [];

    /**
     * Current response body
     * 
     * @var string
     */
    private string $body = '';

    /**
     * Current response code
     * 
     * @var int
     */
    private int $responseCode = 200;

    /**
     * @inheritDoc
     */
    public function setHeader(string $header, string $value): void
    {
        $this->headers[$header] = $value;
    }

    /**
     * @inheritDoc
     */
    public function setHeaders(array $headers): void
    {
        foreach ($headers as $headerName => $headerValue) {
            $this->setHeader($headerName, $headerValue);
        }
    }

    /**
     * @inheritDoc
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @inheritDoc
     */
    public function setResponseCode(int $code = 200): void
    {
        $this->responseCode = $code;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
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

    /**
     * @inheritDoc
     */
    public function redirect(string $url, int $code = 301): void
    {
        $this->setResponseCode($code);
        header('Location: ' . $url);
        $this->emit();
        exit;
    }
}
