<?php

namespace Reyan\Framework\Loader;

use Symfony\Component\Finder\Finder;

abstract class FileLoader
{
    private $finder;

    /**
     * @param Finder $finder The file finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource)
    {
        $file = basename($resource);
        $dir = substr($resource, 0, -strlen($file));

        $files = iterator_to_array($this->getFinder()->files()->name($file.'.'.$this->getExtension())->in($dir));
        $file = reset($files);
        $file = file_get_contents($file);
        $data = $this->parse($file);

        return $this->generate($data);
    }

    /**
     * @return Finder
     */
    private function getFinder()
    {
        return $this->finder;
    }

    /**
     * Parse the file content.
     *
     * @param string $file The file content
     * 
     * @return mixed
     */
    protected function parse($file)
    {
        return $file;
    }

    /**
     * Convert the data into the final result
     *
     * @param mixed $data
     * 
     * @return mixed
     */
    protected function generate($data)
    {
        return $data;
    }

    /**
     * Get the file extension
     *
     * @return string
     */
    abstract protected function getExtension();
}
