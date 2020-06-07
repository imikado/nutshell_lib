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
        $paramList = array();

        $sql = 'INSERT INTO ' . $table_ . ' ';
        foreach ($fieldValueList_ as $field => $value) {
            $placeholderList[] = '?';
            $fieldList[] = $field;
            $paramList[] = $value;
        }
        $sql .= ' (' . implode(',', $fieldList) . ') ';
        $sql .= ' VALUES ';
        $sql .= ' (' . implode(',', $placeholderList) . ') ';

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($paramList);
    }
    public function update($table_, $whereFieldValueList_, $fieldValueList_)
    {
        $lineList = array();
        $whereList = array();
        $paramList = array();

        $sql = 'UPDATE ' . $table_ . ' ';
        $sql .= 'SET ';
        foreach ($fieldValueList_ as $field => $value) {
            $lineList[] = $field . ' = ?';
            $paramList[] = $value;
        }

        foreach ($whereFieldValueList_ as $field => $value) {
            $whereList[] = $field . ' = ?';
            $paramList[] = $value;
        }

        $sql .= ' ' . implode(',', $lineList) . ' ';
        $sql .= 'WHERE ';
        $sql .= ' ' . implode(' AND ', $whereList) . ' ';

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($paramList);
    }

    public function delete($table_, $whereFieldValueList_)
    {
        $whereList = array();
        $paramList = array();

        $sql = 'DELETE FROM ' . $table_ . ' ';

        foreach ($whereFieldValueList_ as $field => $value) {
            $whereList[] = $field . ' = ?';
            $paramList[] = $value;
        }

        $sql .= 'WHERE ';
        $sql .= ' ' . implode(' AND ', $whereList) . ' ';

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($paramList);
    }
}
