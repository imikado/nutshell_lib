<?php 
namespace Nutshell\Interfaces\Http;

interface Request{
    public function getGetParam($param_, $default_ = null);
    public function getGetParamList();
    public function getPostParam($param_, $default_ = null);
    public function getPostParamList();
    public function getPutParamList();
    public function getPutParam($param_, $default_ = null);
    public function getMethod();
    public function getUrl();
}