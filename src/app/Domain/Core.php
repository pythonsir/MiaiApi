<?php
namespace App\Domain;

use App\Common\Util;
use App\Model\Session3rd as Session3rdModel;
use App\Model\Weixin;

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



}