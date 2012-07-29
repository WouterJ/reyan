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
        $routes->add('login', new Route('/login', 'LoginController::login'));
        $routes->add('show_page', new Route('/:slug', 'PageController::show'));

        $request = new Request('/about', 'GET');

        $router = new Router($routes, $request);
        $route = $router->match();

        $this->assertEquals('PageController::show', $route['_controller']);
        $this->assertEquals('about', $route['slug']);

        $route1 = $router->match(new Request('/login', 'GET'));
        $this->assertEquals('LoginController::login', $route1['_controller']);
    }
}
