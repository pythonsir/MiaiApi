<?php
namespace App\Domain;

use PhalApi;
use App\Common\Util;
use App\Model\Session3rd as Session3rdModel;
use App\Model\Weixin;
use App\Model\Sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

/**
 * @author: pythonsir <baidu211@vip.qq.com>
 * @weixin: cxyzxh1388
 */

class Core {


    public function getSession3rd($data){

        $model = new Session3rdModel();

        $data['id'] = Util::createNonceStr();

        $model->getSession3rd($data);

        return $data['id'];
    }

    public function  getOpenidBySession3rd($id){

        $model = new Session3rdModel();

        return $model->getOpenid($id);

    }

    public function saveWeixinInfo($res,$params){


        if (isset($res['openid'])) {

            $data = array_merge(['openId' => $res['openid'],],$params);

            $model = new Weixin();

            $result = $model->saveOrUpdate($data);

            $rs = [];

            if ($result >= 1) {
                // 成功
                $rs['msg'] = '保存成功';
            } else if ($result === 0) {
                // 相同数据，无更新
                $rs['msg'] = '无更新';
            } else if ($result === false) {
                $rs['msg'] = '保存失败';
            }
            return $rs;

        } else {

            return array('msg' => '获取openid失败');

        }
    }

    /**
     * 发送短信
     * @param $phone
     * @param $openid
     */
    public function sendsms($phone,$openid){

        $smsconfig = PhalApi\DI()->config->get("app.AlibabaCloud.sms");

        AlibabaCloud::accessKeyClient($smsconfig['AccessKey'], $smsconfig['AccessKeySecret'])
            ->regionId('cn-hangzhou')
            ->asGlobalClient();

        $code = rand(1000,9999);

        try {
            $result = AlibabaCloud::rpcRequest()
                ->product('Dysmsapi')
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->options([
                    'query' => [
                        'RegionId' => 'cn-hangzhou',
                        'PhoneNumbers' => $phone,
                        'SignName' => $smsconfig['SignName'],
                        'TemplateCode' => $smsconfig['RegisterTemplateCode'],
                        'TemplateParam' => '{"code":"'.$code.'"}',
                    ],
                ])
                ->request();

            \PhalApi\DI()->logger->info('阿里云发送短信响应结果', $result);

            if($result['Code'] === 'OK'){ // 短信发送成功

                $sms = new Sms();

                return $sms->saveSendInfo($phone,$code);

            }else{
                return false;
            }

        } catch (ClientException $e) {
            \PhalApi\DI()->logger->info("发送短信异常", $e);
            return false;
        } catch (ServerException $e) {
            \PhalApi\DI()->logger->info("发送短信异常", $e);
            return false;
        }


    }

    /**
     * 绑定手机号
     */
    public function bindPhone($id,$phone,$smscode,$domain,$openid){


        $smsmodel = new Sms();

        if($smsmodel -> checkCode($id,$smscode)){ //验证通过

            //TODO 保存个人信息到数据库

            return true;

        }else{

            return false;

        }


    }


}