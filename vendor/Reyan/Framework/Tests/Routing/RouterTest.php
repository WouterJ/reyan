<?php

namespace Reyan\Framework\Tests\Routing;

use Reyan\Framework\Routing\Route;
use Reyan\Framework\Routing\Router;
use Reyan\Framework\Routing\RouteCollection;
use Reyan\Framework\HttpKernel\Request;

use \PHPUnit_Framework_TestCase as TC;

class RouterTest extends TC
{
    protected $routes;

    public function setUp()
    {
        $this->routes = new RouteCollection();
        $this->routes->add('homepage', new Route('/', 'WelcomeController::index'));
        $this->routes->add('login', new Route('/login', 'LoginController::login'));
        $this->routes->add('show_page', new Route('/:slug', 'PageController::show'));
    }

    public function testGetCorrectRoutes()
    {
        $request = new Request('/about', 'GET');

        $router = new Router($this->routes, $request);
        $route = $router->match();

        $this->assertEquals('PageController::show', $route['_controller']);
        $this->assertEquals('about', $route['slug']);

        $route1 = $router->match(new Request('/login', 'GET'));
        $this->assertEquals('LoginController::login', $route1['_controller']);
    }

    public function testGenerateRoutes()
    {
        $request = new Request('/foo', 'GET');
        $this->routes->add('show_blog_post', new Route('/:slug/:id', 'PostController::show'));

        $router = new Router($this->routes, $request);

        $this->assertEquals('/hello-world', $router->generate('show_page', array('slug' => 'hello-world')));
        $this->assertEquals('/foobar/12', $router->generate('show_blog_post', array(
            'slug' => 'foobar',
            'id' => 12,
        )));
    }
}
