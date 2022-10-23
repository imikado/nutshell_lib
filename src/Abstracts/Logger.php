<?php

namespace Nutshell\Abstracts;

abstract class Logger
{
    protected $path;
    protected $filename;

    final public function setPath($path_)
    {
        $this->path = $path_;
    }

    final public function setFilename($filename_)
    {
        $this->filename = $filename_;
    }

    final public function logLine($text_)
    {
        $this->_appendLog($this->path . '/' . $this->filename, $text_ . "\n");
    }

    final public function appendLog($path_, $text_)
    {
        \file_put_contents($path_, $text_, FILE_APPEND);
    }
}
