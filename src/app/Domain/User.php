<?php
/**
 * Created by PhpStorm.
 * User: python
 * Date: 2019/2/26
 * Time: 下午3:04
 */

namespace App\Domain;


class User
{
    const USER_IS_FINISH = 1;

    const USER_IS_NOT_FINISH = 0;


    public function saveUserInfo($params){

        $model = new \App\Model\User();

        $model->saveUserInfo($params);

    }

    public function getUserInfo($openid,$isfinish){

        $model = new \App\Model\User();

        $result = $model ->getUserInfo($openid,$isfinish);

        return isset($result['openid']);
    }

}