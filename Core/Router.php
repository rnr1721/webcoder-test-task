<?php

namespace Core;

use Core\Contracts\RouterInterface;
use Core\Contracts\RequestInterface;

/**
 * Class for routing. It check route for matches and if match,
 * it return route data with controller instance
 */
class Router implements RouterInterface
{

    /**
     * System request object
     * 
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * Routes array
     * @var array
     */
    private array $routes;

    public function __construct(array $routes, RequestInterface $request)
    {
        $this->request = $request;
        $this->routes = $routes;
    }

    /**
     * @inheritDoc
     */
    public function route(?string $method = null, ?string $uri = null): array
    {

        if (!$method) {
            $method = $this->request->getRequestMethod();
        }

        if (!$uri) {
            $uri = $this->request->getRequestUri();
        }

        $routes = $this->routes[$method] ?? [];

        $matches = [];

        foreach ($routes as $route => $controller) {
            $pattern = $this->buildPattern($route);

            if (preg_match($pattern, $uri, $matches)) {
                $parameters = $this->extractParameters($matches);
                return [
                    'controller' => $controller,
                    'method' => $method,
                    'parameters' => $parameters,
                ];
            }
        }

        // If no route matches, return the notfound route
        return [
            'controller' => $routes['notfound'] ?? null,
            'method' => $method,
            'parameters' => [],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Build pattern from route
     * 
     * @param string $route
     * @return string
     */
    private function buildPattern(string $route): string
    {
        // We using [^/]+ for capture any symbols before slash
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    /**
     * Extracts parameters from matches array
     * 
     * @param array $matches
     * @return array
     */
    private function extractParameters(array $matches): array
    {
        $parameters = [];

        foreach ($matches as $key => $value) {
            if (is_string($key)) {
                $parameters[$key] = $value;
            }
        }

        return $parameters;
    }
}
