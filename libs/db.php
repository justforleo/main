<?php 
include "database/DbDrive.php";
class db
{
	static public function getInstance()
	{
		$config = yaf_Application::app()->getConfig()->get('database');
        $dbType = $config->dbType;
        $dbHost = $config->dbHost;
        $dbName = $config->dbName;
        $dbPass = $config->dbPass;
        $dbData = $config->dbData;
        $dbPort = $config->dbPort;
        $dbDeBug = $config->dbDebug;
        $db = DbDrive::getInstance($dbDeBug,$dbType,$dbHost,$dbName,$dbPass,$dbData,$dbPort); //DEBUG IS FALSE
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // ERROR MESSAGE IS EXCEPTION
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);// GET RESULT IS FETCH_ASSOC
        $db->query('set names utf8');
        return $db;
	}
}
 ?>