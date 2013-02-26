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
        $filename = basename($resource);
        $directory = substr($resource, 0, -strlen($filename));
        $filename .= '.'.$this->getExtension();

        $files = iterator_to_array($this->getFinder()->files()->in($directory)->name($filename));
        $file = current($files);
        var_dump($file->getFileName());

        return $this->generate($this->parse($file->getContents()));
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
