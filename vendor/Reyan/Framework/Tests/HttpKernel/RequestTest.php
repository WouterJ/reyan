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

    public function testGetPostAndGetParameters()
    {
        $request = new Request('/foo', 'POST', array('name' => 'Wouter'), array('bar' => 'acme'));

        $this->assertEquals('Wouter', $request->getRequest()->name);
        $this->assertEquals('acme', $request->getQuery()->bar);
    }

    public function testServerParameters()
    {
        $request = new Request('/foo', 'POST', array(), array(), array('REQUEST_METHOD' => 'POST'));

        $this->assertEquals('POST', $request->getServer()->REQUEST_METHOD);
    }

    public function testCookies()
    {
        $request = new Request('/foo', 'GET', array(), array(), array(), array('theme_design' => 'bazbar'));

        $this->assertEquals('bazbar', $request->getClient()->theme_design);
    }
}
