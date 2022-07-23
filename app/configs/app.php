<?php

if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 系统配置
 * @author 徐亚坤 hdyakun@sina.com
 */

return array(
    // 应用URL
    'base_url' => 'http://www.jjwxc.net/',
    // 时区设置
    'timezone' => 'Asia/Shanghai',

    'charset' => 'UTF-8',

    'controllers_namespace' => '\\app\\controllers\\',

    'aliases' => array(
        'DB' => '\Core\Db',
        'Route' => '\Core\Route',
        'Request' => '\Core\Request',
        'Response' => '\Core\Response',
        'Input' => '\Core\Input',
        'Config' => '\Core\Config',
    ),
);