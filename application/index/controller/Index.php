<?php
namespace app\index\controller;

use app\common\controller\IsMethod;
use app\common\controller\RestfulTools;
use app\index\model\Company;

class Index extends IsMethod
{
    public function index()
    {
        self::chkGet();
        $company = trim(input('get.company/s'));

        $ret = db('company')
            ->where('companyname','like',"%$company%")
            ->where(['status'=>1])
            ->order('creat_time','desc')
            ->field('id,companyname,addr,website,legal')
            ->limit(20)
            ->Cache(120)
            ->select();
        $count = db('company')
            ->Cache(120)
            ->count('id');
        $type = 0;
        if(count($ret)==0){
            $type = 1;
        }
        $this->assign('ret',$ret);
        $this->assign('type',$type);
        $this->assign('count',$count);
        return $this->fetch();
    }

    public function test()
    {
        return $this->fetch();
    }

    //曝光
    public function exposure()
    {
        return $this->fetch();
    }

    //地区demo
    public function district()
    {
        $key = trim(input('post.key'));  //获取值
        $address[1] = array('朝阳区','海淀区','密云区','延庆区','丰台区','石景山区','门头沟区','房山区','通州区','顺义区','昌平区','大兴区','怀柔区','平谷区','东城区','西城区');
        $address[2] = array('黄浦区','静安区','徐汇区','长宁区','杨浦区','虹口区','普陀区','浦东新区','宝山区','嘉定区','闵行区','松江区','青浦区','奉贤区','金山区');
        $address[3] = array('越秀','海珠','荔湾','天河','白云','黄埔','南沙','番禺','花都','增城','从化');
        $address[4] = array('福田区','罗湖区','南山区','盐田区','宝安区','龙岗区');
        $address[5] = array('拱墅区','萧山区','余杭区','西湖区','上城区','下城区','江干区','滨江区');

        if(!empty($address[$key])){ //有值，组装数据
            $result['status'] = 200;
            $result['data'] = $address[$key];
        }else{  //无值，返回状态码220
            $result['status'] = 220;
        }


        echo json_encode($result);  //返回JSON数据
    }
    //曝光
    public function doExposure()
    {
        self::chkPost();
        $insert['companyname'] = trim(input('post.companyname/s'));
        $insert['addr'] = trim(input('post.addr/s'));
        $insert['legal'] = trim(input('post.legal/s'));
        $insert['content'] = trim(input('post.content/s'));
        $insert['website'] = trim(input('post.website/s'));
        $username = trim(input('post.username/s'));
        $telephone = trim(input('post.telephone/s'));
        $insert['creat_time'] = time();

        if($username)
        {
            $insert['username'] = $username;
        }
        if($telephone)
        {
            $insert['telephone'] = $telephone;
        }

        $Company = new Company();
        $res = $Company->Exposure($insert);
        if($res)
        {
            RestfulTools::restData($res);
        }else{
            RestfulTools::restErr('1009');
        }
    }

}
