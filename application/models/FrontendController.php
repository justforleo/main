<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-8-30
 * Time: 下午5:41
 */
class FrontendControllerModel extends ObjectControllerModel
{
    public function init()
    {
        parent::init();
    }
    /*
     * @todo
     * 如果已经卸载过安装过，可以看情况对他进行删除数据表，来全新安装
     * 可能还有其它用途
     * */
    /*
     * 获得还没有安装的模块
     * */
    public function getModulesList()
    {

    }
    /*
     * 获得已经安装过的模块
     * */
    public function getAlreayInstallModules()
    {

    }
    /*
     * 获得已经卸载过的模块
     * */
    public function getAlreadyUnInstallModules()
    {

    }

}