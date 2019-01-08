<?php
/**
 * 统一访问入口
 */

use EasyWeChat\Factory;

require_once dirname(__FILE__) . '/init.php';

global $miniApp;

$miniProgram = PhalApi\DI()->config->get("app.miniProgram");

$miniApp = Factory::miniProgram($miniProgram);

$pai = new \PhalApi\PhalApi();
$pai->response()->output();

