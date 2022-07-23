<?php

namespace app\daos\pro\sql;

/**
* Board sql
*/

class Board
{
    const listByIds = 'select * from `#table#` where id in (#ids#) order by #order#';

    const store = 'insert into `#table#` (#parameter#) values (#replace#)';
}