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
}
