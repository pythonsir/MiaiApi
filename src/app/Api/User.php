<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Core as CoreDomain;
use App\Domain\User as UserDomain;
use PhalApi\Exception;

/**
 * pythonsir
 * 微信:cxyzxh1388
 * email:baidu211@vip.qq.com
 *
 * 用户模块接口服务
 */
class User extends Api {
    public function getRules() {
        return array(
            'saveUserInfo' => array(
                'session3rd' => array('name'=>'session3rd', 'require' => true),
                'gender' => array('name' => 'gender', 'require' => true),
                'province' => array('name' => 'province', 'require' => true),
                'province' => array('name' => 'province', 'require' => true),
                'county' => array('name' => 'county', 'require' => true),
                'year' => array('name' => 'year', 'require' => true),
                'month' => array('name' => 'month', 'require' => true),
                'day' => array('name' => 'day', 'require' => true),
                'height' => array('name' => 'height', 'require' => true),
                'education' => array('name' => 'education', 'require' => true),
                'marriage' => array('name' => 'marriage', 'require' => true),
                'income' => array('name' => 'income', 'require' => true)
            )
        );
    }
    /**
     * 保存用户信息
     */
    public function saveUserInfo() {

        $params =[
            "gender"=>$this->gender,
            "province"=>$this->province,
            "county"=>$this->county,
            "year"=>$this->year,
            "month"=>$this->month,
            "day"=>$this->day,
            "height"=>$this->height,
            "education"=>$this->education,
            "marriage"=>$this->marriage,
            "income"=>$this->income,
            "is_finish" => 1,
            "createdAt"=>date('Y-m-d H:m:s')
        ];

        $domain = new CoreDomain();

        $res = $domain->getOpenidBySession3rd($this->session3rd);

        $params = array_merge($params,array("openid" => $res['openid']));

        $userDomain = new UserDomain();

        try{

            \PhalApi\DI()->logger->info("保存个人信息", $params );

            $userDomain->saveUserInfo($params);

            return  true ;

        }catch (Exception $e){

            \PhalApi\DI()->logger->info("保存个人信息", $e->getMessage() );

            return false;
        }
    }
} 
