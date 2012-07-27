<?php

namespace Reyan\Framework\Loader;

/**
 * This interface implement all loaders
 *
 * @author Wouter J
 */
interface LoaderInterface
{
    /**
     * Loads the resource.
     *
     * @param mixed $resource
     */
    public function load($resource);
}
