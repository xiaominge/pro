<?php

$config = [
    /* mysql */
    'mysql' => [
        'charset' => 'UTF8',
        'persistent' => false,
        'collation' => 'utf8_unicode_ci',
        'timeout' => 3,
    ],
    /* mysql */

    /* database */
    'database' => [

        'pro' => [
            'dbname' => 'pro',
            'write' => [
                'username' => 'root',
                'password' => 'root',
                'servers' => [
                    '127.0.0.1:3307',
                ],
            ],
            'read' => [
                'username' => 'root',
                'password' => 'root',
                'servers' => [
                    '127.0.0.1:3307',
                ],
            ],
        ],

    ],
    /* database */
];

return $config;