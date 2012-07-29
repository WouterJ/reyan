<?php

namespace Reyan\Framework\Tests\HttpKernel;

use Reyan\Framework\HttpKernel\Request;
use \PHPUnit_Framework_TestCase as TC;

class RequestTest extends TC
{
    public function testGetUriAndMethod()
    {
        $request = new Request('/post/hello-world/1', 'GET');

        $this->assertEquals('/post/hello-world/1', $request->getUri());
        $this->assertEquals('GET', $request->getMethod());
    }

    public function testGetPostAndGetValues()
    {
        $request = new Request('/foo', 'GET', array('name' => 'Wouter'), array('bar' => 'acme'));

        $this->assertEquals('Wouter', $request->getRequest()->name);
        $this->assertEquals('acme', $request->getQuery()->bar);
    }
}
