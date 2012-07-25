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

    public function testAddRoutes()
    {
        $this->collection->addRoute('show_post', new Route('/post/:id', 'RouteController::show'));
        $this->collection->addRoute('delete_post', new Route('/post/delete/:id', 'BackendRouteController::delete'));
        $this->collection->addRoute('create_post', new Route('/post/create', 'BackendRouteController::create'));

        $this->assertCount(3, $this->collection);
    }

    public function testAddCollections()
    {
        $storebundle = new RouteCollection();
        $storebundle->addRoute('frontpage', new Route('/', 'StoreBundle::showFirst10'));
        $storebundle->addRoute('show_product', new Route('/product/:slug', 'StoreBundle::show'));
        $storebundle->addRoute('buy_product', new Route('/product/:slug/buy', 'StoreBundle::buy'));

        $this->collection->addCollection('storebundle', $storebundle);

        $this->assertCount(3, $this->collection);
    }

    public function testAddShortCut()
    {
        $storebundle = new RouteCollection();
        $storebundle->add('frontpage', new Route('/', 'StoreBundle::showFirst10'));
        $storebundle->add('show_product', new Route('/product/:slug', 'StoreBundle::show'));
        $storebundle->add('buy_product', new Route('/product/:slug/buy', 'StoreBundle::buy'));

        $this->collection->add('storebundle', $storebundle);

        $this->assertCount(3, $this->collection);
    }

    public function testMatching()
    {
        $storebundle = new RouteCollection();
        $storebundle->add('frontpage', new Route('/', 'StoreBundle::showFirst10'));
        $storebundle->add('show_product', new Route('/product/:slug', 'StoreBundle::show'));
        $storebundle->add('buy_product', new Route('/product/:slug/buy', 'StoreBundle::buy'));

        $this->collection->add('storebundle', $storebundle);

        $this->assertInternalType('array', $this->collection->match('/product/foo'));
    }
}
