return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [ // Site 1
            'driver'    => 'mysql',
            'host'      => env('DB_HOST'),
            'port'      => env('DB_PORT'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
        'mysql_site2' => [ // Site 2
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_SITE2'),
            'port'      => env('DB_PORT_SITE2'),
            'database'  => env('DB_DATABASE_SITE2'),
            'username'  => env('DB_USERNAME_SITE2'),
            'password'  => env('DB_PASSWORD_SITE2'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ],
];