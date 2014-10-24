<?php

class envPlugin extends Yaf_Plugin_Abstract
{
//    public static $env;
    public function dispatchLoopShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function dispatchLoopStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function postDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response )
    {
    }

    public function preDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function preResponse ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function routerShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
        $_ENV['APP_MODULES'] = $request->getModuleName();
        $_ENV['APP_METHOD'] = $request->getActionName();
        $_ENV['APP_CONTROLLER'] = $request->getControllerName();
    }
    public function getModulesPath()
    {
        echo 1;
    }
    public function __get($key)
    {
        return $_ENV[$key];
    }
    public function __set($key,$val)
    {
        $_ENV[$key] = $val;
    }

    public function routerStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

}