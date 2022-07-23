<?php

namespace app\daos\pro;

/**
 * Board Dao
 */

class Board extends Base
{
    const tableName = 'board';

    public static $defaultSqlMap = array('table' => self::tableName);

    public function listByIds($ids = [])
    {
        $ids = '"' . implode('","', $ids) . '"';
        $order = "FIELD(id, " . $ids . ')';
        $replaceMap = [
            'ids' => $ids,
            'order' => $order,
        ];
        $replaceMap = array_merge($replaceMap, self::$defaultSqlMap);
        return $this->getDb()->fetchAll(sql\Board::listByIds, $replaceMap);
    }

    public function store($formData)
    {
        $formKey = '`' . implode('`,`', array_keys($formData)) . '`';
        $formVal = ':' . implode(',:', array_keys($formData));
        $replaceMap = array(
            'parameter' => $formKey,
            'replace' => $formVal,
        );
        $replaceMap = array_merge($replaceMap, self::$defaultSqlMap);
        $data = $this->getDb()
                ->insert(sql\Board::store, $formData, $replaceMap)
                ->lastInsertId();
        return $data;
    }
}