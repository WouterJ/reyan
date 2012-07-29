<?php

namespace Reyan\Framework\HttpKernel;

class Request
{
    private $uri;
    private $method;
    private $request;
    private $query;
    private $server;
    private $client;

    /**
     * @param string $uri
     * @param string $method          One of the HTTP methods
     * @param array  $post    Optional The POST parameters
     * @param array  $get     Optional The GET parameters
     * @param array  $server  Optional The SERVER parameters
     * @param array  $cookies Optional An array of COOKIES
     */
    public function __construct($uri, $method, $post = array(), $get = array(), $server = array(), $cookies = array())
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->request = (object) $post;
        $this->query = (object) $get;
        $this->server = (object) $server;
        $this->client = (object) $cookies;
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

    /**
     * Gets the Server Parameters.
     *
     * @return StdClass
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Gets the Cookies.
     *
     * @return StdClass
     */
    public function getClient()
    {
        return $this->client;
    }
}
