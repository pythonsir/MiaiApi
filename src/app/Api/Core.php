<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Core as CoreDomain;
use PhalApi\PhalApi;

/**
 * 小程序核心接口服务类
 *
 * @author: pythonsir <baidu211@vip.qq.com>
 * @weixin: cxyzxh1388
 */
class  Core extends Api
{

    public function getRules()
    {
        return array(
            'getSession3rd' => array(
                'code' => array('name' => 'code'),
            ),
            'saveWeixinInfo' => array(
                'nickName' => array('name' => 'nickName'),
                'avatarUrl' => array('name' => 'avatarUrl'),
                'session3rd' => array('name' => 'session3rd'),
            )
        );
    }

    /**
     *  通过小程序code 获取 session_key 和 openid
     */
    public function getSession3rd()
    {

        global $miniApp;

        $code = $this->code;

        $result = $miniApp->auth->session($code);

        \PhalApi\DI()->logger->info("登录小程序", $result);

        $domain = new CoreDomain();

        $session3rd = $domain->getSession3rd($result);

        $rs = $domain->saveWeixinInfo(['openid'=>$result['openid']],['createdAt' => date('Y-m-d H:m:s')]);

        return  array_merge(array('session3rd' => $session3rd),$rs) ;

    }

    /**
     *  保存微信信息
     */
    public function SaveWeixinInfo()
    {

        $domain = new CoreDomain();

        $res = $domain->getOpenidBySession3rd($this->session3rd);

        $params = array(
            'nickName' => $this->nickName,
            'avatarUrl' => $this->avatarUrl,
            'createdAt' => date('Y-m-d H:m:s'),
        );

        return $domain->saveWeixinInfo($res,$params);

    }
}