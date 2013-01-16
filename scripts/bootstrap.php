<?php
date_default_timezone_set('Europe/Paris'); 
$loader = require_once __DIR__.'/../vendor/autoload.php';

$appEnv = include('./application_env.php');

$config = include __DIR__."/../config/$appEnv.php";

use Silex\Application;
$app = new Application();
$app['debug'] = $config['debug'];
$app->register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => $config['db.options']));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
