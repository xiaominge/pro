<?php

namespace app\daos\pro;

use app\daos\Common;

/**
 * Base Model
 */
class Base extends Common
{
    const dbName = 'pro';

    public $fetchType = \PDO::FETCH_ASSOC;

    public $debug = false;
}