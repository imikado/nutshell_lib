<?php

namespace Nutshell\Applications;

class Rest
{
    protected $dependencies;

    public function __construct($dependencies_)
    {
        $this->dependencies = $dependencies_;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }


    public function getRequest()
    {
        return $this->getDependencies()->getRequest();
    }

    public function getResponse()
    {
        return $this->getDependencies()->getResponse();
    }

    public function jsonResponse($output_): \Nutshell\Http\Response
    {
        $response = $this->getResponse();
        $response->setTypeJson();
        $response->setContent($output_);
        return $response;
    }

    public function jsonResponseMethodNotAllowed($message_ = null): \Nutshell\Http\Response
    {
        $response = $this->getResponse();
        $response->setTypeJson();
        $response->setStatusMethodNotAllowed();
        $response->setContent($message_);
        return $response;
    }

    public function jsonResponsePageNotFound($message_ = null): \Nutshell\Http\Response
    {
        $response = $this->getResponse();
        $response->setTypeJson();
        $response->setStatusNotFound();
        $response->setContent($message_);
        return $response;
    }

    public function jsonResponseException(\Exception $e): \Nutshell\Http\Response
    {
        $response = $this->getResponse();
        $response->setTypeJson();
        $response->setStatusError();
        $response->setContent($e->getMessage());
        return $response;
    }
}
