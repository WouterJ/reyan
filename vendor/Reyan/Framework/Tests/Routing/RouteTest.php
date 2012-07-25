<?php

namespace Reyan\Tests\Routing;

use Reyan\Framework\Routing\Route;
use PHPUnit_Framework_TestCase as TC;

class RouteTest extends TC
{
    public function testSimpleRoute()
    {
        $route = new Route('/hello', 'HelloController::index');

        $this->assertInternalType('array', $route->match('/hello'));
        $this->assertInternalType('array', $route->match('/hello/'));
        $this->assertFalse($route->match('/foobar'));
    }

    public function testRouteWithParameters()
    {
        $route = new Route('/book/:id/:slug', 'BookController::show');

        $params = $route->match('/book/1/foobar');
        $this->assertEquals(1, $params['id']);
        $this->assertEquals('foobar', $params['slug']);

        $this->assertFalse($route->match('/book'));
    }
}
