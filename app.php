<?php

use Core\Request;
use Core\Router;

// Turn error reporting on
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Composer
require 'vendor/autoload.php';

// Create system request object
// to access _SERVER and _POST arrays data
$request = new Request();
$routes = require '../config/routes.php';

// Router, for check route matches
$router = new Router($routes, $request);
$controller = $router->route();

// Merge system config with route parametres
$config = include '../config/config.php';
$parameters = array_merge($controller['parameters'], $config);

// Run controller and emit the response
$result = $controller['controller']()->run($parameters);
$result->emit();
