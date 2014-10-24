<?php 

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    public function _initEnv(Yaf_Dispatcher $dispatcher)
    {
        $env = new envPlugin();
        Yaf_Registry::set('env',$env);
        $dispatcher->registerPlugin($env);
    }

	public function _initConfig(Yaf_Dispatcher $dispatcher)
	{
        $conf = new configPlugin();
        Yaf_Registry::set('env',$conf);
        $dispatcher->registerPlugin($conf);
    }

    public function _initRouter(Yaf_Dispatcher $dispatcher)
    {
        if( !$dispatcher->getRequest()->isXmlHttpRequest() )
        {
            $layout = new layoutPlugin('layout.phtml');
            Yaf_Registry::set('layout',$layout);
            $dispatcher->registerPlugin($layout);
        }
    }
    public function _initAjax(Yaf_Dispatcher $dispatcher)
    {
        if ($dispatcher::getInstance()->getRequest()->isXmlHttpRequest()
            &&  'ajax' == $dispatcher::getInstance()->getRequest()->getQuery('type')) {
            define('isAjax',true);
            $dispatcher::getInstance()->autoRender(false);
        }
    }
    public function _initInput(Yaf_Dispatcher $dispatcher)
    {
        $_POST = array_map(function(& $key){
            return addslashes($key);
        },$_POST);
    }
}