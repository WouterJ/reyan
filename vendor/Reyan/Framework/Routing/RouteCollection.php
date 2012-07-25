<?php

namespace Reyan\Framework\Routing;

use \Countable;
use \ArrayIterator;
use \IteratorAggregate;
use \InvalidArgumentException;

/**
 * Holds all routes in a project
 *
 * @author Wouter J
 */
class RouteCollection implements IteratorAggregate, Countable
{
    protected $routes = array();
    protected $prefix;

    /**
     * Adds a route to the collection.
     *
     * @param string $name  The name of the route
     * @param Route  $route
     */
    public function addRoute($name, Route $route)
    {
        $this->routes[(string) $name] = $route;
    }

    /**
     * Adds a collection to this collection
     *
     * @param string          $name       The name of the collection
     * @param RouteCollection $collection
     */
    public function addCollection($name, RouteCollection $collection)
    {
        $this->routes[(string) $name] = $collection;
    }

    /**
     * Shortcut for addRoute() and addCollection()
     */
    public function add($name, $route)
    {
        switch (get_class($route)) {
            case 'Reyan\Framework\Routing\Route' : 
                $this->addRoute($name, $route);
                break;
            case 'Reyan\Framework\Routing\RouteCollection' :
                $this->addCollection($name, $route);
                break;
            default :
                throw new InvalidArgumentException(sprintf(
                                                'Routing only accept Route or RouteCollection objects, but %s is given',
                                                get_class($route)
                                            ));
        }
    }

    /**
     * Get the route which matches with the current URI
     *
     * @param string $uri
     *
     * @return Route
     */
    public function match($uri)
    {
        if (isset($this->prefix)) {
            if (preg_match('|^'.$this->prefix.'(.*?)$|', $uri, $matches)) {
                $uri = $matches[1];
            } else {
                return false;
            }
        }

        foreach ($this as $route) {
            if ($r = $route->match($uri)) {
                return $r;
            }
        }

        return false;
    }

    /**
     * @param string $prefix
     */
    public function addPrefix($prefix)
    {
        $this->prefix = (string) $prefix;
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
