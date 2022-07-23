<?php

namespace app\daos;

use \Core\Db as DB;

class Common
{

    protected static $dbs;
    protected static $daos;
    protected $debug = false;
    protected $fetchType = \PDO::FETCH_CLASS;

    protected function getDb()
    {
        $dbName = static::dbName;
        if (empty(self::$dbs[$dbName])) {
            self::$dbs[$dbName] = DB::pdo($dbName)
                ->setDebug($this->debug)
                ->setFetchStyle($this->fetchType);
        }
//        var_dump(self::$dbs);
        return self::$dbs[$dbName];
    }

    public static function Dao()
    {
        $dbName = static::dbName;
        $tableName = $dbName . '-' . static::tableName;
        if (empty(self::$daos[$tableName])) {
            self::$daos[$tableName] = new static;
        }
//        var_dump(self::$daos);
        return self::$daos[$tableName];
    }
}