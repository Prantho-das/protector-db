<?php
return [
    'route-prefix' => env('PROTECT_DB_ROUTE_PREFIX', 'protect-db'),
    'connection' => env('DB_CONNECTION', 'mysql'),
    'host' => env('DB_HOST', ''),
    'port' => env('DB_PORT', ''),
    'username' => env('DB_USERNAME', ''),
    'password' => env('DB_PASSWORD', ''),
    'database' => env('DB_DATABASE', ''),
    'time' => env('PROTECT_DB_TIME', 'weakly'),
    'backup' => env('PROTECT_DB_BACKUP', true),
];