<?php
/**
 * Created by PhpStorm.
 * User: qichao
 * Date: 2018/5/18
 * Time: 18:01
 */
namespace app\common\controller;


use think\facade\Log;

class RestfulTools{

    public static function restErr($iCode,$aErrData=null,$iIsToken='0')
    {
        $sCodeMsg = self::_getCodeMsg($iCode);
        $reAry = array(
            'code'	=> $iCode,
            'codeMsg'	=> $sCodeMsg,
            'data'	=> ''
        );
        Log::write($reAry,'resful');
        echo json_encode($reAry);
        exit;
    }

    public static function restData($aData = '', $codeMsg = '操作成功',$iIsToken = '0')
    {
        $reAry = array(
            'code' => '200',
            'codeMsg' => $codeMsg,
            'data' => $aData
        );
        Log::write($reAry,'resful');
        echo json_encode($reAry);
        exit;
    }

    private static function _getCodeMsg($iCode)
    {
        return (null!=config("codemsg.$iCode")) ? config("codemsg.$iCode"):'未知错误';
    }
}