<?php
// DIC configuration

use Intervention\Image\ImageManager;

$container = $app->getContainer();

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig( $settings['view']['template_path'], $settings['view']['twig']);

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
  return new entity\Slugger();
};

//PHPMailer class
$container['phpmailer'] = function($c) {
  $settings = $c->get('settings')['phpmailer'];
  $phpmailer = new PHPMailer;
  $phpmailer->setFrom($settings['from'], 'Mailer');
  $phpmailer->isHTML($settings['ishtml']);
  return $phpmailer;
};

//Post class
$container['post'] = function($c) {
  return new admin\Post($c);
};

//Post class
$container['category'] = function($c) {
  return new admin\Category($c);
};

//Authentication
$container['auth'] = function($c) {
  return new entity\Auth($c);
};

//Date
$container['date'] = function($c) {
  $settings = $c->get('settings')['date'];
  return new DateTime(  date( 'Y-m-d H:i:s' ), new DateTimeZone($settings['timezone']));
};

// CategoryList class
$container['Category'] = function($c) {
  return new front\Category($c);
};

// Article class
$container['Article'] = function($c) {
  return new front\Article($c);
};

// OtherF class
$container['OtherF'] = function($c) {
  return new front\OtherF($c);
};

// Comments class
$container['Comment'] = function($c) {
  return new front\Comment($c);
};

// Statistics class
$container['Statistics'] = function($c) {
  return new front\Statistics($c);
};

// Site Settings
// $container['siteSettings'] = function($c) {
//   return new entity\SiteSettings($c);
// };
