<?php
/**
 * Created by PhpStorm.
 * User: chao
 * Date: 2018/9/20
 * Time: 下午5:33
 */
namespace app\admin\model;

use app\common\controller\RestfulTools;
use think\facade\Session;
use think\Model;

class User extends Model
{
    protected $table = 'adminuser';
    public function login($dataArr)
    {

        if(!$dataArr['name'])
        {
            RestfulTools::restErr('1000');
        }
        if(!$dataArr['pwd'])
        {
            RestfulTools::restErr('1002');
        }

        if(!is_array($dataArr))
        {
            RestfulTools::restErr('302');
        }

        $userInfo = User::where(['name'=>$dataArr['name']])->find();

        if(NULL == $userInfo)
        {
            return RestfulTools::restErr('1008');
        }
        //echo password_hash($dataArr['pwd'],PASSWORD_DEFAULT);die;
        if( $userInfo['pwd'] != password_verify($dataArr['pwd'],$userInfo['pwd']))
        {
            RestfulTools::restErr('1010');
        }


        $auth = [
            'id'=>$userInfo['id'],
            'name'=>$userInfo['name'],
        ];
        Session::set('admin_user',$auth);
        return true;
    }

    public function loginout()
    {
        Session::clear();
        return true;
    }
}