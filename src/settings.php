<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/../templates/default',
            'twig' => [
                'cache' => __DIR__ . '/../templates/cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // PDO settings
        'pdo' => [
            'host' => 'localhost',
            'dbname' => 'news_website',
            'port' => '',
            'timeout' => '15',
            'username' => 'root',
            'password' => 'Er751270@'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'news-website',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // PHP Mailer
        'phpmailer' => [
          'from' => 'sales@pizzastore.dev',
          'ishtml' => 'true'
        ],

        // Timezone
        'date' => [
          'timezone' => 'Europe/London',
        ]
    ],
];
