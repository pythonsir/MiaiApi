<?php
namespace App\Common;

/**
 * @author: pythonsir <baidu211@vip.qq.com> 2014-10-04
 * @weixin: cxyzxh1388
 */

class Util
{

    /**
     * 生成32位随机数
     * @param int $length
     * @return string
     */
    public static  function createNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;

    }

}