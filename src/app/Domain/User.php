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
    public function saveUserInfo($params){

        $model = new \App\Model\User();

        $model->saveUserInfo($params);

    }

}