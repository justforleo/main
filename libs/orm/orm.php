<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-7-8
 * Time: 下午9:26
 */
class Orm
{
    private $sql;
    public function find()
    {
        $this->sql = 'select * from '.$this->_tableName;
        return $this;
    }

    public function field()
    {

    }
    public function where($argv1,$argv2,$argv3)
    {
        $this->_where = "{$argv1} {$argv2} {$argv3}";
    }
    public function groupBy($field)
    {
        $this->sql."groupBy {$field}";
    }
    public function orderBy($field,$sort = 'desc')
    {
        $this->sql."orderBy {$field} {$sort}";
    }
    public function join()
    {

    }
    public function limit($argv1,$argv2 = null)
    {
        if(!$argv2) {
            $this->sql .= " limit {$argv1}";
        } else {
            $this->sql .= " limit {$argv1},{$argv2}";
        }
        return $this;
    }
    public function last()
    {

    }
    public function frist()
    {

    }
    public function all()
    {

    }

    public function insert()
    {

    }
    public function insertGetId()
    {

    }
    public function startTran()
    {

    }
    public function commit()
    {

    }
    public function rollBack()
    {

    }
    public function exec($sql = null)
    {
        if (!sql) {
            echo $this->sql;
        } else {

        }
    }
}