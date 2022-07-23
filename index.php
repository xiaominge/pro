<?php

define('NL', PHP_SAPI == 'cli' ? PHP_EOL : "<br>");

define('START_TIME', microtime(true));
define('START_USAGE_MEMORY', memory_get_usage());
define('ENVIRONMENT', getenv('ENVIRONMENT') ?: 'development');
// 目录间隔符
define("DS", DIRECTORY_SEPARATOR);
// 根目录
define('BASEPATH', __DIR__ . DS);
define('APP_FOLDER', 'app');
define('CONFIG_FOLDER', 'configs');
// 应用目录
define('APP_PATH', BASEPATH . APP_FOLDER . DS);
// 应用配置目录
define('CONFIG_PATH', APP_PATH . CONFIG_FOLDER . DS);

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/**
 * 加载文件
 * @param  [string] $file_path [输入的文件路径]
 * @param  [string] $base      [文件所在的基础目录]
 * @param  [string] $key       [路径数组键的前缀]
 * @return [string]            [完整文件路径]
 */
function import($file_path, $base = null, $key = null)
{
    static $paths;
    $key_path = $key ? $key . $file_path : $file_path;

    if (empty($paths[$key_path])) {
        $base = is_null($base) ? BASEPATH : rtrim($base, '/') . DS;
        $path = str_replace('.', DS, $file_path);
        $full_path = $base . $path . '.php';
        $paths[$key_path] = include_once $full_path;
    }

    return $paths[$key_path];
}

// 自动加载、初始化
import('bootstrap.start');
// Routes
import('routes', APP_PATH);
