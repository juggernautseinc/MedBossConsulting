<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

namespace Juggernaut\App;

use Juggernaut\App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;
// remember to return the type hint callable|array when updating to php 8
// removing for right now to keep moving forward
// callable|array $action
    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestUri)
    {
        $route = explode("?", $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
echo "is array";
var_dump($class);
var_dump($method);
            if (class_exists($class)) {
                $class = new $class();
echo "class_exist";
                if (method_exists($class, $method)) {
                    echo "method exist";
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
        echo "what happened? ";
        throw new RouteNotFoundException();
    }
}
