<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 路由
 * @author 徐亚坤 hdyakun@sina.com
 */

Route::get('/', 'index@index');
Route::get('/store', 'index@store');

Route::error(function () {
    throw new \Exception("404 Not Found");
});

Route::dispatch();