<?php

namespace Reyan\Tests\Routing;

use Reyan\Framework\Routing\Route;
use PHPUnit_Framework_TestCase as TC;

class RouteTest extends TC
{
    public function testEasyRoute()
    {
        $route = new Route('/hello', 'HelloController::index');

        $this->assertInternalType('array', $route->match('/hello'));
        $this->assertInternalType('array', $route->match('/hello/'));
        $this->assertFalse($route->match('/foobar'));
    }
}
