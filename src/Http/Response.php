<?php

namespace Nutshell\Http;

class Response
{

    protected $type;
    protected $content;
    protected $statusCode = self::HTTP_STATUS_OK;

    const TYPE_JSON = 'JSON';
    const TYPE_XML = 'XML';

    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_FORBIDDEN = 403;
    const HTTP_STATUS_NOTFOUND = 404;
    const HTTP_STATUS_METHODNOTALLOWED = 405;
    const HTTP_STATUS_ERROR = 500;

    public function __construct()
    {
    }

    public function display()
    {
        if ($this->type == self::HTTP_STATUS_METHODNOTALLOWED) {
            header($this->getMethodAsked() . ' ' . self::HTTP_STATUS_METHODNOTALLOWED . ' Method Not Allowed', true, self::HTTP_STATUS_METHODNOTALLOWED);
        } else if ($this->type == self::HTTP_STATUS_NOTFOUND) {
            header("HTTP/1.0 404 Not Found", true, self::HTTP_STATUS_NOTFOUND);
        }

        if ($this->type == self::TYPE_JSON) {
            header('Content-type:application/json;charset=utf-8', true, $this->statusCode);
            echo json_encode($this->content);
        }
    }

    public function getMethodAsked()
    {
        return $_SERVER["SERVER_PROTOCOL"];
    }

    public function setContent($content_)
    {
        $this->content = $content_;
    }

    public function setTypeJson()
    {
        $this->type = self::TYPE_JSON;
    }

    public function setStatusCode($code_)
    {
        $this->statusCode = $code_;
    }
    public function setStatusOk()
    {
        $this->setStatusCode(self::HTTP_STATUS_OK);
    }
    public function setStatusForbidden()
    {
        $this->setStatusCode(self::HTTP_STATUS_FORBIDDEN);
    }
    public function setStatusNotFound()
    {
        $this->setStatusCode(self::HTTP_STATUS_NOTFOUND);
    }
    public function setStatusMethodNotAllowed()
    {
        $this->setStatusCode(self::HTTP_STATUS_METHODNOTALLOWED);
    }
    public function setStatusError()
    {
        $this->setStatusCode(self::HTTP_STATUS_ERROR);
    }
}
