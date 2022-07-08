<?php

namespace App\Dispatcher;

use App\Config\Config;
use App\Controller\ControllerInterface;
use App\Controller\Factory\ControllerFactoryInterface;
use App\Request\Request;

class RouteDispatcher
{
    // 1630, 000, 000 (1.630 million) => remaining
    // Daddy Ebun would loan us 1M
    // 2.630 M 
    // 5.5 million
    /**
     * @param string $requestUri
     */
    public static function dispatch(string $requestUri): void
    {
        $parts = explode('?', $requestUri);

        list($path, $query) = array_pad($parts, 2, null);

        parse_str($query, $params);

        $routes = Config::get('routes');
        if (!array_key_exists($path, $routes)) {
            $path = '/404';
        }

        $parts = explode('@', $routes[$path]);
        list($controllerName, $action) = $parts;

        $controller = static::locateController($controllerName);
        $request = new Request($params, $_POST);

        $controller->$action($request);
    }

    /**
     * @param string $name
     * 
     * @return ControllerInterface
     */
    private static function locateController(string $name): ControllerInterface
    {
        $config = Config::get('controllers');

        if(in_array($name, $config['invokables'])) {
            return new $name();
        }

        if(array_key_exists($name, $config['factories'])) {
            $factoryClass = $config['factories'][$name];

            $factory = new $factoryClass();
            if(!$factory instanceof ControllerFactoryInterface) {
                throw new \RuntimeException(sprintf('Wrong factory registered for %s', $name));
            }

            return $factory->create();
        }

        return throw new \RuntimeException(sprintf('Unable instantiate controller %s', $name)); 
    }
}