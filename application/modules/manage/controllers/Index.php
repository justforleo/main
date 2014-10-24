<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-10-9
 * Time: 下午3:24
 */
class IndexController extends FrontendControllerModel
{
    /*
     * @methodName
     * */
    function indexAction()
    {

        /*
         * 这个地方算是后台，主要进行
         * modules管理
         * modules权限管理
         * @todo 动态调用栏目，比如一个modules的功能 ，不一定非要进这个modules板块里才能用，或者，可以让modules调用系统api来做一些页面？比如cms功能，
         * 以及访问这个地方需要不需要登录,方法的中文名字可以用@methodName来定义，这样就可以在Rules里看到中文的，目前想到的方法是扫描文件来获得methodName
         * */

    }
    function buttonsAction()
    {

    }
}