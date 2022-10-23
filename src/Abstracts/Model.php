<?php

namespace Nutshell\Abstracts;

use Exception;

abstract class Model
{
    protected static $sgbdInstanceList = array();
    protected $table;
    protected $sgbdName;
    protected $configList;

    public function __construct($sgbd_)
    {
        $this->setSgbd($sgbd_);
    }

    public function getSgbd()
    {
        return self::$sgbdInstanceList[$this->sgbdName];
    }
    public function setSgbd($sgbd_)
    {
        $this->sgbdName = $sgbd_->getName();
        if (!isset(self::$sgbdInstanceList[$this->sgbdName])) {
            self::$sgbdInstanceList[$this->sgbdName] = $sgbd_;
        }
    }

    final public function insert($fieldValueList_)
    {
        return $this->getSgbd()->insert($this->table, $fieldValueList_);
    }
    final public function update($whereIdList_, $fieldValueList_)
    {
        return $this->getSgbd()->update($this->table, $whereIdList_, $fieldValueList_);
    }
    final public function delete($whereIdList_)
    {
        return $this->getSgbd()->delete($this->table, $whereIdList_);
    }
}
