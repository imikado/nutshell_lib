<?php

namespace Nutshell\Abstracts;

abstract class Module
{
    private $dependencies;

    public function __construct(\Nutshell\Interfaces\Dependencies $dependencies_)
    {
        $this->dependencies = $dependencies_;
    }

    protected function getDependencies()
    {
        return $this->dependencies;
    }
}
