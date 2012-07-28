<?php

namespace Reyan\Framework\Routing\Loader;

use Reyan\Framework\Routing\Route;
use Reyan\Framework\Routing\RouteCollection;
use Reyan\Framework\Loader\YmlFileLoader;

class YmlRoutesLoader extends YmlFileLoader
{
    /**
     * {@inheritdoc}
     *
     * @return RouteCollection In which all routes (and other collections) are stored
     */
    protected function generate($data)
    {
        $collection = new RouteCollection();

        foreach ($data as $name => $options) {
            if (isset($options['resource'])) {
                // resource
                $route = $this->load($options['resource']);
            } else {
                // route
                if (!isset($options['defaults'])) {
                    $options['defaults'] = array();
                }
                if (!isset($options['requirements'])) {
                    $options['requirements'] = array();
                }
                if (!isset($options['method'])) {
                    $options['method'] = 'ALL';
                }

                $route = new Route($options['pattern'], $options['controller'], $options['defaults'], $options['requirements'], $options['method']);
            }

            $collection->add($name, $route);
        }

        return $collection;
    }
}
