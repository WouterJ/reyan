<?php

namespace Reyan\Framework\Tests\Routing;

use Reyan\Framework\Routing\Route;
use Reyan\Framework\Routing\Router;
use Reyan\Framework\Routing\RouteCollection;
use Reyan\Framework\HttpKernel\Request;

use \PHPUnit_Framework_TestCase as TC;

class RouterTest extends TC
{
    public function testGetCorrectRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('homepage', new Route('/', 'WelcomeController::index'));
        $routes->add('show_page', new Route('/:slug', 'PageController::show'));
        $routes->add('login', new Route('/login', 'LoginController::login'));

        $request = new Request('/about', 'GET');

        $router = new Router($routes, $request);
        $route = $router->match();

        $this->assertEquals('PageController::show', $route['_controller']);
    }
}
