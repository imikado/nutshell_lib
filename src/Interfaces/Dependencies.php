<?php

namespace Nutshell\Interfaces;

interface Dependencies
{
    public function setConfigList(array $configList_);
    public function getConfigList(): array;
    public function getConfig();

    public function getRequest();
    public function getResponse();
}
