<?php
namespace app\admin\controller;

use app\admin\model\User;
use app\common\controller\IsMethod;
use app\common\controller\RestfulTools;
use think\facade\Route;
use think\facade\Session;

class Index extends IsMethod
{
    public function login()
    {
        return $this->fetch();
    }
    public function dologin()
    {
        self::chkPost();
        $dataArr['name'] = trim(input('post.name/s'));
        $dataArr['pwd'] = trim(input('post.pwd/s'));
        $User = new User();
        $res = $User->login($dataArr);
        if(true === $res)
        {
            RestfulTools::restData('200','登录成功');
        }
    }

    public function loginout()
    {
        $User = new User();
        $res = $User->loginout();
        if(true === $res){
            $this->redirect('admin/Index/login');
        }
    }

    public function index()
    {
        return $this->fetch();
    }


    //数据列表
    public function exposure()
    {
//        dump(Session::get('admin_user'));

        $res = db('company')->select();
        $count = db('company')->Cache(120)->count('id');
        $this->assign('dataArr',$res);
        $this->assign('count',$count);
        return $this->fetch();
    }
    //下架
    public function article_stop()
    {
        self::chkPost();
        $id = trim(input('post.id/d'));
        $where['status'] = 0;
        $res = db('company')->where(['id'=>$id])->update($where);
        if($res)
        {
            RestfulTools::restData('8007');
        }else{
            RestfulTools::restErr('1009');
        }
    }
    //上架
    public function article_start()
    {
        self::chkPost();
        $id = trim(input('post.id/d'));

    }
}
