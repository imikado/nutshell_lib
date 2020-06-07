<?php

namespace Nutshell\Sgbd;

class Pdo
{
    protected $name;
    protected $dbh = null;

    public function __construct($name_, $dsn_, $username_, $password_, $options_ = null)
    {
        $this->name = $name_;
        $this->dbh = new \PDO($dsn_, $username_, $password_, $options_);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPdo()
    {
        return $this->dbh;
    }

    public function findMany($sql_, $paramList_ = array())
    {
        $sth = $this->dbh->prepare($sql_);
        $sth->execute($paramList_);

        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }
    public function findOne($sql_, $paramList_ = array())
    {
        $sth = $this->dbh->prepare($sql_);
        $sth->execute($paramList_);

        $rowList = $sth->fetchAll(\PDO::FETCH_OBJ);
        if (isset($rowList[0])) {
            return $rowList[0];
        }
        return null;
    }
    public function execute($sql_, $paramList_ = array())
    {
        $sth = $this->dbh->prepare($sql_);
        return $sth->execute($paramList_);
    }
    public function insert($table_, $fieldValueList_)
    {
        $fieldList = array();
        $placeholderList = array();
        $valueList = array();
        $sql = 'INSERT INTO ' . $table_ . ' ';
        foreach ($fieldValueList_ as $field => $value) {
            $placeholderList[] = '?';
            $fieldList[] = $field;
            $valueList[] = $value;
        }
        $sql .= ' (' . implode(',', $fieldList) . ') ';
        $sql .= ' VALUES ';
        $sql .= ' (' . implode(',', $placeholderList) . ') ';

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($valueList);
    }
    public function update($table_, $whereFieldValueList_, $fieldValueList_)
    {
        $lineList = array();
        $whereList = array();
        $valueList = array();

        $sql = 'UPDATE ' . $table_ . ' ';
        $sql .= 'SET ';
        foreach ($fieldValueList_ as $field => $value) {
            $lineList[] = $field . ' = ?';
            $valueList[] = $value;
        }

        foreach ($whereFieldValueList_ as $field => $value) {
            $whereList[] = $field . ' = ?';
            $valueList[] = $value;
        }

        $sql .= ' ' . implode(',', $lineList) . ' ';
        $sql .= 'WHERE ';
        $sql .= ' ' . implode(' AND ', $whereList) . ' ';

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($valueList);
    }
}
