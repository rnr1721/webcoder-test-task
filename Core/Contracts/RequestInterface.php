<?php

namespace Core\Contracts;

/**
 * This interface return data from SERVER array and any request data
 */
interface RequestInterface
{

    /**
     * Return _SERVER array
     * 
     * @return type
     */
    public function getVars(): array;

    /**
     * Return request URI
     * 
     * @return string
     */
    public function getRequestUri(): string;

    /**
     * Return request method
     * 
     * @return string
     */
    public function getRequestMethod(): string;

    /**
     * If request is ajax?
     * 
     * @return bool
     */
    public function isAjax(): bool;

    /**
     * Get data from _POST array
     * 
     * @return array
     */
    public function getPostData(): array;
}
