<?php

use App\Dispatcher\RouteDispatcher;

require __DIR__ . '/../vendor/autoload.php';

\App\Config\Config::init();

$requestUri = $_SERVER['REQUEST_URI'];

RouteDispatcher::dispatch($requestUri);