<?php

namespace Core;

use Core\Contracts\RequestInterface;

/**
 * This class for get data from _SERVER and _POST arrays
 */
class Request implements RequestInterface
{

    private array $post;
    private array $server;

    public function __construct(array $server = [], array $post = [])
    {
        $this->server = (empty($server) ? $_SERVER : $server);
        $this->post = (empty($post) ? $_POST : $post);
    }

    /**
     * @inheritdoc
     */
    public function getVars(): array
    {
        return $this->server;
    }

    /**
     * @inheritdoc
     */
    public function getRequestUri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    /**
     * @inheritdoc
     */
    public function getRequestMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * @inheritdoc
     */
    public function isAjax(): bool
    {
        if (isset($this->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->server['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getPostData(): array
    {
        return $this->post;
    }
}
