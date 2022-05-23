<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

use Juggernaut\App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $route, callable $action): self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri)
    {
        $route = explode("?", $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        return call_user_func($action);
    }
}
