<?php

namespace Nutshell\Routing;

class Manager
{
    protected $request;
    protected $routeList;
    protected $status;

    protected $routeFound = null;

    const STATUS_ROUTE_FOUND = 'ROUTE_FOUND';
    const STATUS_METHOD_NOT_ALLOWED = 'METHOD_NOTALLOWED';
    const STATUS_ROUTE_NOT_FOUND = 'ROUTE_NOT_FOUND';

    public function __construct(\Nutshell\Http\Request $request_)
    {
        $this->request = $request_;
    }

    public function add($method_, $pattern_, $function_)
    {
        $this->routeList[] = array(
            'method' => $method_,
            'pattern' => $pattern_,
            'function' => $function_,
        );
    }

    public function process()
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

        $path = $parsedUrl['path'];

        $patternFound = false;

        foreach ($this->routeList as $route) {
            if (preg_match($route['pattern'], $path, $matches)) {

                if ($this->isMethod($route['method'])) {
                    array_shift($matches);
                    $this->status = self::STATUS_ROUTE_FOUND;
                    return call_user_func_array($route['function'], $matches);
                }
                $patternFound = true;
            }
        }

        if ($patternFound) {
            $this->status = self::STATUS_METHOD_NOT_ALLOWED;
            return false;
        } else {
            $this->status = self::STATUS_ROUTE_NOT_FOUND;
        }
        return null;
    }

    public function isStatusRouteFound()
    {
        if ($this->status == self::STATUS_ROUTE_FOUND) {
            return true;
        }
        return false;
    }

    public function isStatusMethodNotAllowed()
    {
        if ($this->status == self::STATUS_METHOD_NOT_ALLOWED) {
            return true;
        }
        return false;
    }

    public function isStatusRouteNotFound()
    {
        if ($this->status == self::STATUS_ROUTE_NOT_FOUND) {
            return true;
        }
        return false;
    }

    public function isMethod($method_)
    {
        if (trim(strtolower($this->request->getMethod())) == trim(strtolower($method_))) {
            return true;
        }
        return false;
    }

    public function match($pattern_, $varList_ = array(), &$matchedList_ = null)
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

        $path = $parsedUrl['path'];

        if (count($varList_) and  $matchedList_ !== null) {
            $tmpMatchedList = array();
            if (preg_match($pattern_, $path, $tmpMatchedList)) {
                array_shift($tmpMatchedList);
                foreach ($varList_ as $key => $var) {
                    $matchedList_[$var] = $tmpMatchedList[$key];
                }
                return true;
            }
        } else {
            if (preg_match($pattern_, $path)) {
                return true;
            }
        }


        return false;
    }
}
