<?php

namespace Reyan\Framework\Routing;

use Reyan\Framework\Routing\Route;
use Reyan\Framework\Routing\RouteCollection;
use Reyan\Framework\HttpKernel\Request;

class Router
{
    private $routes;
    private $request;

    /**
     * @param RouteCollection $routes  The RouteCollection with all routes and other collections
     * @param Request         $request The current request
     */
    public function __construct(RouteCollection $routes, Request $request)
    {
        $this->routes = $routes;
        $this->request = $request;
    }

    /**
     * Matches the routes with the given request or the request of the constructor.
     *
     * @param  Request $request Optional The current request
     *
     * @return Route
     */
    public function match(Request $request = null)
    {
        $request || ($request = $this->request);

        return $this->routes->match($request->getUri());
    }
}
