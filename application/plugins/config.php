<?php

class configPlugin extends Yaf_Plugin_Abstract
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

        $module = $request->getModuleName();
        if ($module != 'Index') {
            $resHref = ROOT."/application/modules/{$module}";
        } else {
            $resHref = ROOT."/application";
        }
        $newConfig = new yaf_config_ini($resHref.'/modules.ini');
        $requestModuleConfig = include_once($resHref.'/config.php');
        if (!$requestModuleConfig) {
            $requestModuleConfig = [];
        }
        $this->config = Yaf_Application::app()->getConfig()->toArray();
        $this->config = array_merge($this->config,$newConfig->toArray(),$requestModuleConfig);
        Yaf_Registry::set('conf',$this->config);
        define('APP_ROOT',$this->config['application']['directory']);
    }

}