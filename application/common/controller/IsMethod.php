<?php
/**
 * Created by PhpStorm.
 * User: chao
 * Date: 2018/7/17
 * Time: 下午2:39
 */
namespace app\common\controller;

use think\Controller;
use think\facade\Request;

class IsMethod extends Controller
{
    //判断是不是 post 请求
    public static function chkPost(){
        return self::_chkMethod('post');
    }

    //判断是不是 get 请求
    public static function chkGet(){
        return self::_chkMethod('get');
    }

    private static function _chkMethod($sMethod='get'){

        if($sMethod=='post'){
            if(!Request::isPost()){
                RestfulTools::restErr('602');
            }
        }

        if($sMethod=='get'){
            if(!Request::isGet()){
                RestfulTools::restErr('601');
            }
        }

    }
}