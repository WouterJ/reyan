<?php

namespace Reyan\Framework\Tests\Routing;

use \PHPUnit_Framework_TestCase as TC;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\Finder;

use Reyan\Framework\Routing\Router;
use Reyan\Framework\Routing\Loader\YmlRoutesLoader;
use Reyan\Framework\HttpKernel\Request;

class RoutingText extends TC
{
    public function testRouting()
    {
        $routesLoader = new YmlRoutesLoader(new Finder(), new Parser());
        $routes = $routesLoader->load(__DIR__.'/../Fixtures/Routing/routecomplete');

        $this->assertCount(4, $routes);
        $this->markTestIncomplete('Because it produces an error');
    }
}
