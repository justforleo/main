<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-7-8
 * Time: 下午8:52
 */
class articleModel
{
    protected $_tableName = 'demo';

    public function __construct()
    {
        $this->_db = db::getInstance();
    }

    public function getArticle($num = null)
    {
        return $this->_db->findOne($this->_tableName);
    }

    public function delArticle()
    {

    }

    public function addArticle()
    {

    }

}