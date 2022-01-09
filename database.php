<?php declare(strict_types=1);

$config = array (
    'dbname' => 'classicmodels',
    'user' => 'app_classicmodels',
    'password' => 'admin',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
    'type' => 'mysql',

);

return new PDO("{$config['type']}:host={$config['host']};dbname={$config['dbname']}",
                  $config['user'], $config['password']);
