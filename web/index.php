<?php
// comment for git on ovh1
$loader = require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Monolog\Handler\ChromePHPHandler;

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'local'));
$config = include __DIR__.'/../config/'.APPLICATION_ENV.'.php';

$app = new Application();
$app['debug'] = $config['debug'];

/*
*  INIT SERVICE PROVIDERS
*/
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.options' => array('cache' => __DIR__.'/../cache', 'strict_variables' => true),
		'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/../cache/',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => $config['db.options']));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


/*
 * FRONT
 */
$app->get('/', 'Controller\IndexController::indexAction')->bind('home');

/*
 * AJAX
 */
$ajax = $app['controllers_factory'];
$ajax->match('/get', 'Controller\IndexController::doAjax')->bind('do_ajax');
$app->mount('/ajax', $ajax);


// let's go
$app->run();
// $app['http_cache']->run();
