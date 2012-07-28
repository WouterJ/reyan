<?php

namespace Reyan\Framework\Tests\Routing\Loader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

use Reyan\Framework\Routing\Loader\YmlRoutesLoader;

use \PHPUnit_Framework_TestCase as TC;

class YmlRoutesLoaderTest extends TC
{
    public function testRouteCollection()
    {
        $routesLoader = new YmlRoutesLoader(new Finder(), new Parser());

        $routes = $routesLoader->load(__DIR__.'/../../Fixtures/routes');

        $this->assertInstanceOf('Reyan\Framework\Routing\RouteCollection', $routes);
    }
}
