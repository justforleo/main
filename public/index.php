<?php 	

define('ROOT', realpath(dirname(__FILE__).'/../'));
$app = new Yaf_Application(ROOT.'/conf/app.ini');
$app->bootstrap()->run();
 ?>