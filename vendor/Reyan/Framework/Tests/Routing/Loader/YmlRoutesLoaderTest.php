<?php

namespace Reyan\Framework\Tests\Routing\Loader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

use Reyan\Framework\Routing\Loader\YmlRoutesLoader;

use \PHPUnit_Framework_TestCase as TC;

class YmlRoutesLoaderTest extends TC
{
    private $routesLoader;
    private $routes;
    
    public function setUp()
    {
        $this->routesLoader = new YmlRoutesLoader(new Finder(), new Parser());
        $this->routes = $this->routesLoader->load(__DIR__.'/../../Fixtures/Routing/routes');
    }

    public function tearDown()
    {
        $this->routesLoader = null;
        $this->routes = null;
    }

    public function testRouteCollection()
    {
        $this->assertInstanceOf('Reyan\Framework\Routing\RouteCollection', $this->routes);
        $this->assertCount(2, $this->routes);
    }

    public function testRoutes()
    {
        $this->assertInstanceOf('Reyan\Framework\Routing\Route', reset(iterator_to_array($this->routes)));
    }

    public function testResources()
    {
        $routes = $this->routesLoader->load(__DIR__.'/../../Fixtures/Routing/routeswithresource');

        $this->assertInstanceOf('Reyan\Framework\Routing\RouteCollection', $routes);
        $this->assertCount(2, $routes);
        $this->assertInstanceOf('Reyan\Framework\Routing\RouteCollection', reset(iterator_to_array($routes)));
    }
}
