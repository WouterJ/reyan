<?php

namespace Reyan\Tests\Routing;

use PHPUnit_Framework_TestCase as TC;
use Reyan\Framework\Routing\Route;
use Reyan\Framework\Routing\RouteCollection;

class RouteCollectionTest extends TC
{
    protected $collection;

    public function setUp()
    {
        $this->collection = new RouteCollection();
    }

    public function testCountSingleRouteCollection()
    {
        $this->collection->addRoute('show_post', new Route('/post/:id', 'RouteController::show'));
        $this->collection->addRoute('delete_post', new Route('/post/delete/:id', 'BackendRouteController::delete'));
        $this->collection->addRoute('create_post', new Route('/post/create', 'BackendRouteController::create'));

        $this->assertCount(3, $this->collection);
    }
}
