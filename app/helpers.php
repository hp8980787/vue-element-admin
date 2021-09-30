<?php

use Illuminate\Support\Facades\Config;

function setDatabase( object $database,string $connection='order'): void
{
    Config::set('database.connections.' . $connection, [
        'driver' => 'mysql',
        'host' => $database->ip,
        'port' => $database->port,
        'database' => $database->database,
        'username' => $database->username,
        'password' => $database->passwd,
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
    ]);
}
