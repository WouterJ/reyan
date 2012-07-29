<?php

namespace Reyan\Framework\HttpKernel;

class Request
{
    private $uri;
    private $method;
    private $query;
    private $request;

    /**
     * @param string $uri
     * @param string $method          One of the HTTP methods
     * @param array  $post   Optional The POST parameters
     * @param array  $get    Optional The GET parameters
     */
    public function __construct($uri, $method, $post = array(), $get = array())
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->request = (object) $post;
        $this->query = (object) $get;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Gets the Request Parameters (POST).
     *
     * @return StdClass
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Gets the Query Parameters (GET).
     *
     * @return StdClass
     */
    public function getQuery()
    {
        return $this->query;
    }
}
