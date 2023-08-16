<?php

use Core\Request;
use Core\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

$request = new Request();
$routes = require '../config/routes.php';

$router = new Router($routes, $request);

$controller = $router->route();

$config = include '../config/config.php';

$parameters = array_merge($controller['parameters'], $config);

$result = $controller['controller']()->run($parameters);

$result->emit();
