<?php
namespace App\Api;

require dirname(dirname(dirname(__DIR__))).'/data/data.php';

use PhalApi\Api;

/**
 * 数据字典api
 *
 * @author: pythonsir <baidu211@vip.qq.com>
 * @weixin: cxyzxh1388
 */

class Dictionary extends Api{


    /**
     * 获取省市县
     */
    public function getArea(){

        return array('area'=>arealist);

    }


}

