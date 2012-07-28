<?php

namespace Reyan\Framework\Loader;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\Finder;

class YmlFileLoader extends FileLoader
{
    private $parser;

    /**
     * {@inheritdoc}
     *
     * @param Parser $parser A Yaml File Parser
     */
    public function __construct(Finder $finder, Parser $parser)
    {
        $this->parser = $parser;

        parent::__construct($finder);
    }

    /**
     * {@inheritdoc}
     */
    protected function parse($file)
    {
        return $this->getParser()->parse($file);
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtension()
    {
        return 'yml';
    }

    /**
     * @return Parser
     */
    private function getParser()
    {
        return $this->parser;
    }
}
