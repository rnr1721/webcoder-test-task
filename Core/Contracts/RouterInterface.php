<?php

namespace Core\Contracts;

/**
 * Interface for routing. It check that current uri in routing array.
 * If route match, it return the route data with controller object.
 */
interface RouterInterface
{

    /**
     * Check the route
     * 
     * @param string|null $method Request method
     * @param string|null $uri Uri for check
     * @return array Route route data for next processing
     */
    public function route(?string $method = null, ?string $uri = null): array;

    /**
     * Get all routes
     * 
     * @return array
     */
    public function getRoutes(): array;
}
