<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-10-9
 * Time: 下午3:24
 */
class RulesController extends FrontendControllerModel
{

    /*
     * @methodName 121312
     * */
    function indexAction()
    {
    }

    /*
     * @methodName 23423
     * */
    function addAction()
    {
        $a = parse::run(__FILE__);
        var_dump($a);
    }
}