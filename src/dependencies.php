<?php
// DIC configuration

use Intervention\Image\ImageManager;

$container = $app->getContainer();

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    return $view;
};

//PDO
$container['pdo'] = function ($c) {
  $settings = $c->get('settings')['pdo'];
  $dsn = 'mysql:host=' . $settings['host'] .
         ';dbname='    . $settings['dbname'] .
         ';port='      . $settings['port'] .
         ';connect_timeout=' . $settings['timeout'];
  $username = $settings['username'];
  $password = $settings['password'];
  $timezone = date_default_timezone_get();
  $pdo = new PDO($dsn, $username, $password);
  $pdo->exec("SET CHARACTER SET utf8");
  $pdo->exec("SET time_zone = '{$timezone}'");
  return $pdo;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// slim flash
$container['flash'] = function ($c) {
  return new \Slim\Flash\Messages();
};

// Image Upload
$container['imgupload'] = function ($c) {
  return new ImageManager();
};

// Slugify
$container['slugger'] = function ($c) {
  include 'entity/Slugger.php';
  return new Slugger();
};

//PHPMailer class
$container['phpmailer'] = function($c) {
  $settings = $c->get('settings')['phpmailer'];
  $phpmailer = new PHPMailer;
  $phpmailer->setFrom($settings['from'], 'Mailer');
  $phpmailer->isHTML($settings['ishtml']);
  return $phpmailer;
};
