<?php
/**
 * Created by PhpStorm.
 * User: python
 * Date: 2019/2/26
 * Time: 下午3:14
 */

namespace App\Model;

use PhalApi\Exception;
use PhalApi\Exception\InternalServerErrorException;
use PhalApi\Model\NotORMModel as NotORM;


class User extends NotORM
{
    public function saveUserInfo($params){

        try{

            $this->insert($params);

            return true;

        }catch (Exception $e){

            throw new InternalServerErrorException($e->getMessage(),$e->getCode());

        }

    }

    public function getUserInfo($openid,$isfinish){

      $row =  $this->getORM()->where('openid = ?',$openid)->where('is_finish = ?',$isfinish)->fetchOne();

        \PhalApi\DI()->logger->info("查询是否存在用户信息", $row);

        return $row;

    }

}