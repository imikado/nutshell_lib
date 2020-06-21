<?php

namespace Nutshell\Abstracts;

abstract class Logger
{
    protected $path;
    protected $filename;

    public function _setPath($path_){
        $this->path=$path_;
    }

    public function _setFilename($filename_){
        $this->filename=$filename_;
    }

    public function _logLine($text_){
        $this->_appendLog($this->path.'/'.$this->filename,$text_."\n");
    }

    public function _appendLog($path_,$text_){
        \file_put_contents($path_,$text_,FILE_APPEND);
    }
}