<?php 

class UserController extends FrontendControllerModel
{
    private $_layout;

    public function init()
    {
        $this->_layout = Yaf_Registry::get('layout');
        $this->getView()->assign('key',1);
    }
    public function mainAction()
    {
        $this->_layout->siteTitle = '用户中心';
    }
}
