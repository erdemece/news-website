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
            'username' => 'news_website',
            'password' => 'Er751270@'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'news-website',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // PHP Mailer
        'phpmailer' => [
          'isSmtp' => 'yes',                                     // Set mailer to use SMTP
          'smtp_host' => 'mail.erdemece.om',  // Specify main and backup SMTP servers
          'smtp_auth' => true,                              // Enable SMTP authentication
          'smtp_username' => 'erdem@erdemece.com',                 // SMTP username
          'smtp_password'=> 'Er!316497!_',                           // SMTP password
          'smtp_secure' => 'tls',                            // Enable TLS encryption, `ssl` also accepted
          'smtp_port' => 587,                                    // TCP port to connect to
          'from' => 'sales@kurdishquestion.com',
          'ishtml' => true
        ],

        // Timezone
        'date' => [
          'timezone' => 'Europe/London',
        ]
    ],
];
