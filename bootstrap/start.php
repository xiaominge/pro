<?php
/**
 * 初始化
 * @author 徐亚坤 hdyakun@sina.com
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Composer 自动加载
import('vendor.autoload');
// 类别名
$appConfig = \Core\Config::get('app');
$aliases = $appConfig['aliases'];
foreach ($aliases as $class => $fullClass) {
    class_alias($fullClass, $class);
}
// BASE_URL
define('BASE_URL', $appConfig['base_url']);
// TIME_ZONE
date_default_timezone_set($appConfig['timezone']);
// 初始化请求
Request::init();
// 初始化响应
Response::init();
