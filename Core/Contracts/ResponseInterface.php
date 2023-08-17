<?php

namespace Core\Contracts;

/**
 * Any controller must return this interface.
 * It collects data for emitting response
 */
interface ResponseInterface
{

    /**
     * Set header, that will be send on response
     * 
     * @param string $header Header name
     * @param string $value Header value
     * @return void
     */
    public function setHeader(string $header, string $value): void;

    /**
     * Set headers as key=>value array that will be send on response
     * 
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void;

    /**
     * Set response body
     * 
     * @param string $body
     * @return void
     */
    public function setBody(string $body): void;

    /**
     * Set response code, that will be sent on response emit
     * 
     * @param int $code
     * @return void
     */
    public function setResponseCode(int $code = 200): void;

    /**
     * Get current response headers
     * 
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Get current response code
     * 
     * @return int
     */
    public function getResponseCode(): int;

    /**
     * Get current response body
     * 
     * @return string
     */
    public function getBody(): string;

    /**
     * Emit response with current data (Response code, headers, body)
     * 
     * @return void
     */
    public function emit(): void;

    /**
     * Redirect to another page by Location header
     * 
     * @param string $url Url to redirect
     * @param int $code 300 or 301. Response code for redirect
     * @return void
     */
    public function redirect(string $url, int $code = 301): void;
}
