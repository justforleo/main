<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-8-30
 * Time: 下午5:30
 * @todo 对Model进行Rule功能可以在表字段注释上做规则
 */
class ObjectControllerModel extends Yaf_Controller_Abstract
{
    public $_layout;
    /*
     * 对布局自动工作
     *
     * @return void
     * */
    public function init()
    {
        $this->_layout = Yaf_Registry::get('layout');
        $this->_layout->siteTitle = $this->getConfig('title');
        $this->_layout->load = $this->getConfig('load');
    }
    /*
     * 获得config里的内容并处理
     *
     * @param String $field 目前只有load（js文件或css文件）和title
     * @return Array | String $returnRes
     * */
    protected  function getConfig($field)
    {
        if (isset(Yaf_Registry::get('conf')[$field])) {
            $res = Yaf_Registry::get('conf')[$field];
        } else {
            return false;
        }
        // 格式：*
        $all[] = isset($res['*'])?$res['*']:'';
        // 格式：xxx/*
        $all[] = isset($res[$_ENV['APP_CONTROLLER'].'/*'])?$res[$_ENV['APP_CONTROLLER'].'/*']:null;
        // 格式：xxx/xxx
        $all[] = isset($res[$_ENV['APP_CONTROLLER'].'/'.$_ENV['APP_METHOD']])?$res[$_ENV['APP_CONTROLLER'].'/'.$_ENV['APP_METHOD']]:null;
        // 数组去空
        $all = array_filter($all);
        switch($field) {
            case 'load':
                $returnRes = [];
                foreach($all as $key => $value) {
                        $returnRes = array_merge($returnRes,explode(',',$value));
                }
                break;
            case 'title':
                // 取最后一个
                $key = count($all) == 1?0:count($all)-1;
                $returnRes = $all[$key];
                break;
        }
        return $returnRes;
    }
    /*
     * 返回modules.ini里对应内容
     *
     * @param String $field  当前控制器下的方法的ini字段
     * @param String $method 当前控制器下的方法
     * @return Array $conf
     * */
    public function getModuleIni($field,$method = null)
    {
        $parentCtrl = class_parents($this);
        $parentCtrl = array_shift($parentCtrl);
        $parentCtrl = str_replace('ControllerModel','',$parentCtrl);
        $action = $method?$method:$_ENV['APP_METHOD'];
        $ctrl = $_ENV['APP_CONTROLLER'];
        $modules = $_ENV['APP_MODULES'];
        $conf = Yaf_Registry::get('conf');
        if (isset($conf['message'][$parentCtrl][$modules][$ctrl.ucfirst($action)][$field])) {
            return $conf['message'][$parentCtrl][$modules][$ctrl.ucfirst($action)][$field];
        }
        return false;
    }
    /*
     * 输出msg视图并输出ini里对应字段内容
     *
     * @param String $field
     * @return void
     * */
    public function displayMethodMessage($field)
    {
        $conf = Yaf_Registry::get('conf');
        $file = $conf['mainMessageFile'];
        $field = $this->getModuleIni($field);
        $this->getView()->assign($field);
        $this->getResponse()->setBody($this->getView()->render($file));
        yaf_dispatcher::getinstance()->autorender(false);
    }
    /*
     * 返回ini里对应字段内容
     *
     * @param String $field
     * @return String $res
     * */
    public function getMessageIni($field,$flag = 'Global')
    {
        $conf = Yaf_Registry::get('conf')->toArray();
        if (isset($conf['message'][$flag][$field])) {
            $res = $conf['message'][$flag][$field];
        } else {
            $res = false;
        }
        return $res;
    }
}
