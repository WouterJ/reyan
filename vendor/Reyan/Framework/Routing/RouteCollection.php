<?php

namespace Reyan\Framework\Routing;

use \Countable;
use \ArrayIterator;
use \IteratorAggregate;

/**
 * Holds all routes in a project
 *
 * @author Wouter J
 */
class RouteCollection implements IteratorAggregate, Countable
{
    protected $routes = array();

    /**
     * Adds a route to the collection.
     *
     * @param string                        $name  The name of the route
     * @param Reyan\Framework\Routing\Route $route
     */
    public function addRoute($name, Route $route)
    {
        $this->routes[(string) $name] = $route;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->routes);
    }

    public function count()
    {
        $count = 0;
        foreach ($this as $route) {
            $count += ($route instanceof RouteCollection
                          ? count($route)
                          : 1
                      );
        }
        
        return $count;
    }
}
