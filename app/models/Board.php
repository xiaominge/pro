<?php

namespace app\models;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use \app\daos\pro\Board as BoardDao;

/**
 * 模型类
 * @author 徐亚坤 hdyakun@sina.com
 */

class Board extends Base
{

    public function __construct()
    {

    }

    public static function listByIds($ids = array())
    {
        return BoardDao::Dao()->listByIds($ids);
    }

    public static function store($data)
    {
        $data = BoardDao::Dao()->store($data);
        return $data;
    }

}