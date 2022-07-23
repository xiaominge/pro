<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Board as BoardModel;
use Input;
use Response;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $page = Input::all('page') ?: 1;
        $pageSize = 50;
        $offset = ($page - 1) * $pageSize;
        // 从Zset获取数据
        $redis = connect_redis();
        $resources = $redis->zRevRangeByScore('board-list', '+inf', '-inf', [
            'withscores' => false,
            'limit' => array($offset, $pageSize),
        ]);
    
        if (empty($resources)) {
            $jsonArr = [
                'code' => 200,
                'msg' => '没有更多数据',
                'data' => '',
            ];
        } else {
            $list = BoardModel::listByIds($resources);
            $jsonArr = [
                'code' => 200,
                'msg' => 'OK',
                'data' => $list,
            ];
        }
        $json = json_encode($jsonArr);
        Response::setBody($json)->send();
        debug();
    }

    public function storeAction()
    {
        $data = [];
        $data['subject'] = Input::all('subject');
        $data['Author'] = Input::all('Author');
        $data['Idate'] = $Idate = Input::all('Idate') ?: time();
        $data['Replies'] = Input::all('Replies') ?: '0';
        $data['Body'] = Input::all('Body');
        $data['Ndate'] = $Ndate = Input::all('Ndate') ?: time();
        $data['Ip'] = Input::all('Ip', '');
        $data['Idate'] = date("Y-m-d H:i:s", $Idate);
        $data['Ndate'] = date("Y-m-d H:i:s", $Ndate);
        // 数据存入MySQL
        $ret = BoardModel::store($data);
        // 插入成功返回ID
        if (intval($ret) > 0) {
            $jsonArr = [
                'code' => 200,
                'msg' => 'OK',
                'data' => $ret,
            ];
            // 数据存入Zset
            $redis = connect_redis();
            $redis->zAdd('board-list', $Idate, $ret);
        } else {
            $jsonArr = [
                'code' => 500,
                'msg' => '添加失败',
                'data' => '',
            ];
        }
        
        $json = json_encode($jsonArr);
        Response::setBody($json)->send();
        debug();
    }

}