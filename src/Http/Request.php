<?php

namespace Nutshell\Http;

class Request
{

    protected $_GET = array();
    protected $_POST = array();
    protected $_PUT = array();

    public function __construct()
    {
        $this->_GET = $_GET;
        $this->_POST = $_POST;
        parse_str(file_get_contents('php://input'), $this->_PUT);
    }

    public function getGetParam($param_, $default_ = null)
    {
        if (isset($this->_GET[$param_])) {
            return $this->_GET[$param_];
        }
        return $default_;
    }
    public function getGetParamList()
    {
        return $this->_GET;
    }
    public function getPostParam($param_, $default_ = null)
    {
        if (isset($this->_POST[$param_])) {
            return $this->_POST[$param_];
        }
        return $default_;
    }
    public function getPostParamList()
    {
        return $this->_POST;
    }
    public function getPutParamList()
    {
        return $this->_PUT;
    }
    public function getPutParam($param_, $default_ = null)
    {
        if (isset($this->_PUT[$param_])) {
            return $this->_PUT[$param_];
        }
        return $default_;
    }
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    public function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
