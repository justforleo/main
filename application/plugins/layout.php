<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-9-11
 * Time: 下午8:16
 */

class layoutPlugin extends Yaf_Plugin_Abstract
{
    private $_layoutDir;
    private $_layoutFile;
    private $_layoutVars =array();

    public function __construct($layoutFile, $layoutDir=null){
        $this->_layoutFile = $layoutFile;
        $this->_layoutDir = ($layoutDir) ? $layoutDir : ROOT.'/application/';
    }



    public function dispatchLoopShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function dispatchLoopStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function postDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){
        /* get the body of the response */
        $body = $response->getBody();

        /*clear existing response*/
        $response->clearBody();
        /*如果modules是index就加载modules外的那个views里的文件*/
        $dir = $request->getModuleName()!='Index'?$this->_layoutDir.'modules/'.$request->getModuleName().'/views':$this->_layoutDir.'/views';
        /* wrap it in the layout */
        $layout = new Yaf_View_Simple($dir);
        $layout->content = $body;
        $layout->assign('layout', $this->_layoutVars);

        /* set the response to use the wrapped version of the content */
        $response->setBody($layout->render($this->_layoutFile));
    }

    public function preDispatch ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function preResponse ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function routerShutdown ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }

    public function routerStartup ( Yaf_Request_Abstract $request , Yaf_Response_Abstract $response ){

    }
    public function  __set($name, $value) {
        $this->_layoutVars[$name] = $value;
    }
}