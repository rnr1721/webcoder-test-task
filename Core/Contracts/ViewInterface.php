<?php

namespace Core\Contracts;

/**
 * Simple PHP template engine interface
 */
interface ViewInterface
{

    /**
     * Render the PHP template
     * 
     * @param string $template Template filename
     * @param array $data Key=>value data for use in templates
     * @param int $responseCode Response code for emit
     * @param array $headers Headers array (key=>value)
     * @return ResponseInterface Ready for emit response object
     */
    public function render(
            string $template,
            array $data = [],
            int $responseCode = 200,
            array $headers = []): ResponseInterface;

    /**
     * Get system response object
     * that collects body, response code and headers array
     * 
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;
}
