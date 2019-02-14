<?php
/**
 * 请在下面放置任何您需要的应用配置
 *
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author dogstar <chanzonghuang@gmail.com> 2017-07-13
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
    ),

    /**
     * 接口服务白名单，格式：接口服务类名.接口服务方法名
     *
     * 示例：
     * - *.*         通配，全部接口服务，慎用！
     * - Site.*      Api_Default接口类的全部方法
     * - *.Index     全部接口类的Index方法
     * - Site.Index  指定某个接口服务，即Api_Default::Index()
     */
    'service_whitelist' => array(
        'Site.Index',
    ),

    /**
     * 小程序的appid 和 appsecret
     */
    'miniProgram' => array(

        'app_id' => '',
        'secret' => '',

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',

        'log' => [
            'level' => 'debug',
            'file' =>   __DIR__.'/../runtime/wechat.log',
        ],
    ),
    /**
     * 阿里云配置
     */
    'AlibabaCloud' => array(
        'sms' => array(
            'AccessKey' => '',
            'AccessKeySecret' => '',
            'SignName' => '阿里云短信测试专用',
            'RegisterTemplateCode' => 'SMS_89515010',
        )
    ),
);
