<?php

/**
 * 连接Redis
 * @param  [int]        $database [选择数据库]
 * @return [bool|Redis]           [返回false或实例]
 */
function connect_redis($database = null)
{
    $redis = new \Redis();
    if (!$redis->connect('localhost', 6379)) {
        return false;
    } else {
        if ($database != "") {
            $redis->select((int)$database);
        }
        return $redis;
    }
}

function debug()
{
    if (Input::all('debug')) {
        echo NL . NL;
        echo microtime(true) - START_TIME;
        echo NL . NL;
        echo memory_get_usage() - START_USAGE_MEMORY;
    }
}
