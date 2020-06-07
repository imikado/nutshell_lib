<?php

namespace Nutshell\Abstracts;

abstract class Dependencies
{

    protected $configList = array();
    protected $request;
    protected $response;

    public function setConfigList(array $configList_)
    {
        $this->configList = $configList_;
    }

    public function getConfigList()
    {
        return $this->configList;
    }

    public function getConfig($var_)
    {
        if (!isset($this->configList[$var_])) {
            throw new \Exception('Var "' . $var_ . '" not found in config');
        };
        return $this->configList[$var_];
    }

    public function setRequest(\Nutshell\Http\Request $request_)
    {
        $this->request = $request_;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setResponse(\Nutshell\Http\Response $response_)
    {
        $this->response = $response_;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
