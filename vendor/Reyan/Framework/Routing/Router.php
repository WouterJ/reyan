<?php

namespace Reyan\Framework\Routing;

use \InvalidArgumentException;
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
        $request || ($request = $this->getRequest());

        return $this->routes->match($request->getUri());
    }

    /**
     * Generates a route with the given parameters
     *
     * @param string $name                The name of the route (as given in the RouteCollection)
     * @param array  $parameters Optional The parameters of the route
     *
     * @return string
     */
    public function generate($name, array $parameters = array())
    {
        try {
            $route = $this->getRoutes()->getRoute($name);
            $pattern = $route->getPattern();

            return preg_replace_callback('|:(\w+)|', function($matches) use ($parameters) {
                if (!array_key_exists($matches[1], $parameters)) {
                    throw new InvalidArgumentException(sprintf(
                                  'We cannot create the route, because we missed parameter %s.', 
                                  $matches[1]
                              ));
                }

                return $parameters[$matches[1]];
            }, $pattern);
        } catch (InvalidArgumentException $e) {
            return '/';
        }
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
