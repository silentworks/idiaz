<?php
return array(
    'default' => 'mysql',

    'connections' => array(

        'mysql' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'sharemyideas',
            'user' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
        ),
    )
);