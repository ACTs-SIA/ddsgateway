'connections' => [
    'mysql' => [ // This is your 'site1'
        'driver'    => 'mysql',
        'host'      => env('DB_HOST'),
        'port'      => env('DB_PORT'),
        'database'  => env('DB_DATABASE'),
        'username'  => env('DB_USERNAME'),
        'password'  => env('DB_PASSWORD'),
        // ...
    ],

    'mysql_site2' => [ // Explicitly map the Site 2 env vars
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_SITE2'),
        'port'      => env('DB_PORT_SITE2'),
        'database'  => env('DB_DATABASE_SITE2'),
        'username'  => env('DB_USERNAME_SITE2'),
        'password'  => env('DB_PASSWORD_SITE2'),
        // ...
    ],
],