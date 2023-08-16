<?php

namespace Core\Contracts;

interface ResponseInterface
{
    public function setHeader(string $header, string $value): void;
    public function setHeaders(array $headers): void;
    public function setBody(string $body): void;
    public function setResponseCode(int $code = 200): void;
    public function emit(): void;
    public function redirect(string $url, int $code = 301): void;
}
