<?php

namespace App\Model;

use EasyWeChat\Kernel\Exceptions\Exception;
use PhalApi\Model\NotORMModel as NotORM;

/**
 * @author: pythonsir <baidu211@vip.qq.com>
 * @weixin: cxyzxh1388
 */


class Session3rd  extends NotORM
{

    public function getSession3rd($data){

            \PhalApi\DI()->logger->info('插入tb_session3rd数据', $data);

            $this->insert($data);

    }

    public function getOpenid($id){

        \PhalApi\DI()->logger->info('获取openid ', $id);

        $row = $this->getORM()->where('id',$id)->fetchOne();

        return $row;

    }


}