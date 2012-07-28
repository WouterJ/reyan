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
     *
     * @todo Remove the globals and use a good technique
     */
    public function load($resource)
    {
        $GLOBALS['filename'] = basename($resource);
        $directory = substr($resource, 0, -strlen($GLOBALS['filename']));
        $GLOBALS['filename'] .= '.'.$this->getExtension();

        $files = $this->getFinder()->files()->in($directory)->filter(function($file) {
            return $GLOBALS['filename'] == $file->getFileName();
        });
        $file = current(iterator_to_array($files));

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
