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

    public function _insert($fieldValueList_)
    {
        return $this->getSgbd()->insert($this->table, $fieldValueList_);
    }
    public function _update($whereIdList_, $fieldValueList_)
    {
        return $this->getSgbd()->update($this->table, $whereIdList_, $fieldValueList_);
    }
    public function _delete($whereIdList_)
    {
        return $this->getSgbd()->delete($this->table, $whereIdList_);
    }
}
