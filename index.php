<?php

require __DIR__ . '/vendor/autoload.php';

$router = new Gears\Router();
$router->routesPath = 'app/routes.php';
$router->dispatch();
