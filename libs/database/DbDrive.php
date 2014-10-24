<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 14-4-18
 * Time: 下午8:22
 */
class DbDrive
{
    private static $_instalce = NULL;
    private $_db = NULL;
    private $_deBug = FALSE;
    private function __construct($deBug,$dbType,$dbHost,$dbName,$dbPass,$dbData ,$dbPort = NULL)
    {
        $this->_deBug = $deBug;
        switch($dbType)
        {
            case 'mysql':
                $dbPort = is_null($dbPort)?3306:$dbPort;
                break;
            case 'mssql':
                $dbType = 'sqlsrv';
                $dbPort = is_null($dbPort)?1433:$dbPort;
                break;
        }
        $this->_db = $this->_sql($dbType,$dbHost,$dbName,$dbPass,$dbData,$dbPort);
        return $this->_db;
    }
    public static function getInstance($deBug,$dbType,$dbHost,$dbName,$dbPass,$dbData,$dbPort = NULL,$setAttr = NULL)
    {
        if(is_null(self::$_instalce))
        {
            self::$_instalce = new self($deBug,$dbType,$dbHost,$dbName,$dbPass,$dbData,$dbPort,$setAttr);
        }
        return self::$_instalce;
    }
    private function _sql($dbType,$dbHost,$dbName,$dbPass,$dbData,$dbPort,$setAttr = NULL)
    {
        return new PDO("$dbType:host=$dbHost;port=$dbPort;dbname=$dbData", $dbName, $dbPass,$setAttr);
    }
    /*
     * @param query string
     * return result
     */
    public function query($query)
    {
        if($this->_deBug == TRUE)
        {
            print_r($query);
            echo "<hr>";
        }

        return $this->_db->query($query);
    }
    /*
     * @param bool boolen
     * return void
     */
    public function autoCommit($bool)
    {
        $this->_db->setAttribute(PDO::ATTR_AUTOCOMMIT,$bool);
    }
    public function beginTransaction()
    {
        return $this->_db->beginTransaction();
    }
    public function commit()
    {
        return $this->_db->commit();
    }
    public function rollback()
    {
        return $this->_db->rollback();
    }

    public function setAttribute($key,$val)
    {
        $this->_db->setAttribute($key,$val);
    }

    /*
     * @pargam tab   string
     * @pargam field array|string
     * @pargam where array
     * @pargam log   string |Limit,Order,Group
     * */
    public function findOne($tab,$field = '*',$where = NULL,$log = NULL)
    {
        $query = $this->select($tab,$field,$where,$log);
        return $this->query($query)->fetch();
    }
    public function find($tab,$field = '*',$where = NULL,$log = NULL)
    {
        $query = $this->select($tab,$field,$where,$log);
        return $this->query($query)->fetchAll();
    }
    private function select($tab,$field = '*',$where = NULL,$log = NULL)
    {
        $query = "select";
        if(is_array($field))
        {
            $string = '';
            foreach($field as $key => $val)
            {
                if(is_numeric($key))
                {
                    $string .= " $val ";
                }
                else
                {
                    $string .= " $key as $val, ";
                }
            }
            $query .= $string;
        }
        else
        {
            $query .= " $field ";
        }
        $query .= " from $tab ";//select * from $tab;
        if(isset($where) && !is_null($where))
        {
            if(is_array($where))
            {
                $string = '';
                foreach($where as $key => $val)
                {
                    $string .= " $key = '$val' and ";
                }
                $string = rtrim($string,'and ');
            }
            $query .= "where".$string;
        }
        if(!is_null($log))
        {
            $query .= ' '.$log;
        }
        return $query;
    }
    /*
     * disable
     * return int;
     * */
    protected  function getLastInsertId()
    {
        return $this->_db->lastInsertId();
    }
    /* disable
     * return int;
     * */
    protected function getAffected()
    {
        return $this->_db->rowCount();
    }
    /*
     * @pargam tab string
     * @param field array
     * @param method string|default into |insert into、insert replace
     * */
    public function insert($tab,$field,$method = 'into')
    {
        $query = "insert ".$method." $tab ";
        if(is_array($field))
        {
            $fields = '';
            $value = '';
            $left = '(';
            $right = ')';
            foreach($field as $key=> $val)
            {
                $fields .= "$key,";
            }
            foreach($field as $key=> $val)
            {
                $value .= "'$val',";
            }
            $fields = rtrim($fields,',');
            $value = rtrim($value,',');
            $query = $query.$left.$fields.$right.' values '.$left.$value.$right;
            $this->_db->query($query);
            return $this->getLastInsertId();
        }
    }
    /*
     * @param tab   string
     * @param set   array
     * @param where array
     * */
    public function update($tab,$set,$where)
    {
        $query = "update $tab set";
        if(is_array($set))
        {
            $setString = '';
            foreach($set as $key => $val)
            {
                $setString .= " {$key} = '{$val}',";
            }
            $setString = rtrim($setString,',');
        }
        if(is_array($where))
        {
            $string = '';
            foreach($where as $key => $val)
            {
                $string .= "{$key} = '{$val}' and ";
            }
            $string = trim($string,'and ');
        }

        $query = $query .$setString.' where '.$string;
        $db = $this->_db->query($query);
        return $db->rowCount();
    }
    public function delete($tab,$where)
    {

        $query = "delete from $tab ";
        if(is_array($where))
        {
            $string = '';
            foreach($where as $key => $val)
            {
                $string .= "$key = '$val' and ";
            }
            $string = rtrim($string,'and ');
            $query = $query.' where '.$string;
            $db = $this->_db->query($query);
            return $db->rowCount();
        }
    }


}