<?php
/**
 * Created by PhpStorm.
 * User: chao
 * Date: 2018/9/14
 * Time: 下午5:09
 */
namespace app\index\controller;

use app\common\controller\IsMethod;
use app\common\controller\RestfulTools;

class View extends IsMethod
{
    //详情
    public function details()
    {
        self::chkPost();
        $id = input('post.id');
        $res = db('company')->where(['id'=>$id])->find()['content'];
        if($res)
        {
            RestfulTools::restData($res);
        }
    }
}