<?php
/**
 * Created by PhpStorm.
 * User: python
 * Date: 2019/2/12
 * Time: 下午3:18
 */

namespace App\Model;
use EasyWeChat\Kernel\Exceptions\Exception;
use PhalApi\Model\NotORMModel as NotORM;
use App\Common\Util;

class Sms extends NotORM
{
    /**
     * 保存发送短信记录
     */
    public function saveSendInfo($phone,$code){

        $params = array(
            'id' => Util::createNonceStr(),
            'phone' => $phone,
            'code' => $code,
            'createdAt' => date('Y-m-d H:m:s')
        );

        try{

            \PhalApi\DI()->logger->info('发送短信记录', $params);

            $this->getORM()->insert($params);

            return $params['id'];

        }catch (Exception $e){

            \PhalApi\DI()->logger->info('插入数据库异常发送短信记录', $e);

            return false;
        }

    }

    /**
     * 对比验证码是否正确
     */
    public function checkCode($id,$smscode){

      $model =  $this->getORM()->select('code')->where('id', $id)->fetchOne();

       if($model['code'] != $smscode){

           return false;

       }else{

          return true;

       }

    }

}