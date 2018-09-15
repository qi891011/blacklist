<?php
/**
 * Created by PhpStorm.
 * User: chao
 * Date: 2018/9/14
 * Time: 下午3:07
 */
namespace app\index\model;

use app\common\controller\RestfulTools;
use think\Model;

class Company extends Model
{
    public function Exposure($insert)
    {
        $ret = db('company')->where(['companyname'=>$insert['companyname']])->find();
        if($ret)
        {
            RestfulTools::restErr('8002');
        }
        return db('company')->insert($insert);
    }


}
