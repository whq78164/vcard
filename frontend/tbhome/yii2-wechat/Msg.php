<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-02-21
 * Time: 0:36
 */

namespace frontend\tbhome\wechat;


class Msg
{
    /**
     * 返回错误信息 ...
     * @param int $code 错误码
     * @param string $errorMsg 错误信息
     * @return Ambigous <multitype:unknown , multitype:, boolean>
     */
    public static function returnErrMsg($code,  $errorMsg = null) {
        $returnMsg = array('error_code' => $code);
        if (!empty($errorMsg)) {
            $returnMsg['custom_msg'] = $errorMsg;
        }
        $returnMsg['custom_msg'] = '出错啦！'.$returnMsg['custom_msg'];
        exit($returnMsg['custom_msg']);
    }
}