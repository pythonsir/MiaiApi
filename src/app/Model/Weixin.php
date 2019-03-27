<?php

namespace App\Model;
use PhalApi\Model\NotORMModel as NotORM;


/**
 * @author: pythonsir <baidu211@vip.qq.com>
 * @weixin: cxyzxh1388
 */

class Weixin extends NotORM
{
    /**
     * 插入或者更新用户的微信信息
     * @param $data
     */
    public function saveOrUpdate($data){


        \PhalApi\DI()->logger->info('插入获取更新用户信息 $data', $data);

        $update = $data;

        unset($update['openId'],$update['createdAt']);

        $update['updatedAt'] = date('Y-m-d H:m:s');

        \PhalApi\DI()->logger->info('插入获取更新用户信息 $update', $update);

        return $this->getORM()->insert_update(['openId' => $data['openId']],$data,$update);

    }
}