<?php

namespace Reyan\Framework\Tests\Loader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

use Reyan\Framework\Loader\YmlFileLoader;

use \PHPUnit_Framework_TestCase as TC;

class YmlFileLoaderTest extends TC
{
    public function testYmlParsing()
    {
        $fileLoader = new YmlFileLoader(new Finder(), new Parser());
        $data = $fileLoader->load(__DIR__.'/../Fixtures/Routing/routes');

        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('show_post', $data);
        $this->assertEquals('/post/:slug/:id', $data['show_post']['pattern']);
    }
}
