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
            ),
            'getPhone' => array(
                'encryptedData' => array('name' => 'encryptedData'),
                'iv' => array('name' => 'iv'),
                'session3rd' => array('name' => 'session3rd'),
            ),
            'sendSms' => array(
                'session3rd' => array('name' => 'session3rd'),
                'phone' => array('name' => 'phone'),
            ),
            'bindPhone' => array(
                'id' => array('name' => 'id'),
                'session3rd' => array('name' => 'session3rd'),
                'phone' => array('name' => 'phone'),
                'smscode' => array('name' => 'smscode')
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

    /**
     *  获取小程序用户手机号
     */
    public function getPhone(){

        global $miniApp;

        try{

            $encryptedData = $this->encryptedData;

            $iv = $this->iv;

            $domain = new CoreDomain();

            $res = $domain->getOpenidBySession3rd($this->session3rd);

            $session_key = $res['session_key'];

            \PhalApi\DI()->logger->info("获取用户手机号", array("encryptedData" => $encryptedData,"iv" => $iv,"session_key" => $session_key));

            $decryptedData = $miniApp->encryptor->decryptData($session_key, $iv, $encryptedData);

            $params = array(
                'updatedAt' => date('Y-m-d H:m:s'),
                'phone' => $decryptedData['purePhoneNumber'],
                'countryCode' => $decryptedData['countryCode']
            );
            $domain->saveWeixinInfo($res,$params);

            return true;

        }catch (\Exception $e){

            \PhalApi\DI()->logger->info("获取小程序用户手机号", $e->getMessage());

            return false;
        }





    }

    /**
     *  发送阿里云短信验证码
     */
    public function  sendSms(){

        $phone = $this->phone;

        $domain = new CoreDomain();

        $res = $domain->getOpenidBySession3rd($this->session3rd);

        $openid = $res['openid'];

        \PhalApi\DI()->logger->info("发送手机号验证码", array("phone" => $phone,"openid" => $openid));

        return $domain -> sendsms($phone,$openid);

    }


    /**
     * 绑定手机号
     */
    public function bindPhone(){

        try{

            $id = $this->id;

            $phone = $this -> phone;

            $domain = new CoreDomain();

            $res = $domain->getOpenidBySession3rd($this->session3rd);

            $openid = $res['openid'];

            return $domain->bindPhone($id,$phone,$this->smscode,$domain,$openid);

        }catch (\Exception $e){

            \PhalApi\DI()->logger->info("绑定手机号", $e->getMessage());

            return false;
        }



    }

}