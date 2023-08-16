<?php

namespace Core\Contracts;

interface ViewInterface
{
    public function render(
            string $template,
            array $data = [],
            int $responseCode = 200,
            array $headers = []): ResponseInterface;
    public function getResponse(): ResponseInterface;
}
