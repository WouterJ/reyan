<?php

namespace Reyan\Framework\Routing;

/**
 * This class represents one single route
 *
 * @author Wouter J
 */
class Route
{
    protected $pattern;
    protected $action;
    protected $defaults;
    protected $requirements;
    protected $_rgx;

    /**
     * @param string $pattern               The pattern of the route
     * @param string $action                The action ("controller::action")
     * @param array  $defaults     Optional The defaults for parameters in the route
     * @param array  $requirements Optional The requirements for the parameter
     */
    public function __construct($pattern, $action, array $defaults = array(), array $requirements = array())
    {
        $this->name = (string) $name;
        $this->pattern = (string) $pattern;
        $this->action = (string) $action;
        $this->defaults = $defaults;
        $this->requirements = $requirements;
    }

    /**
     * Match a URI to this route
     *
     * @param  string $uri
     *
     * @return boolean
     */
    public function match($uri)
    {
        if (null === $this->_rgx) {
            $this->setRegex($this->pattern);
        }

        if (preg_match($this->_rgx, $uri)) {
        }
    }

    /**
     * Create the regex to match the route
     *
     * @access protected
     */
    protected function setRegex($pattern)
    {
        $this->_rgx = '|';
        $this->_rgx .= preg_replace('|:(\w*)|', '(?P<$1>.*?)', $pattern);
        $this->_rgx .= ('/' != substr($pattern, -1)
                            ? '/'
                            : ''
                       ).'|';
    }

    public function getPattern() 
    {
        return $this->pattern;
    }

    public function getAction() 
    {
        return $this->action;
    }

    public function getDefaults() 
    {
        return $this->defaults;
    }
    public function getRequirements() 
    {
        return $this->requirements;
    }
}
