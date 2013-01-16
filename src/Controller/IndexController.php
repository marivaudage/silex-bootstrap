<?php

namespace Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// use Model\MyClass;

class IndexController
{
  public function indexAction(Application $app) {
    $response = new Response($app['twig']->render('index.html.twig'));
    return $response;
  }
  
  public function doAjax(Application $app, Request $request, $format = 'json') {
    $params = $request->query->all();
    
    $values = array('a' => 1, 'b' => 'hello');
    // $values = MyClass::doStuff($app['db'], $params);

    switch ($format) {
      case 'json':
        return $app->json($values);
        break;
      case 'html':
        // return new Response($app['twig']->render('block/tweets.html.twig', array('values' => $values)));
        break;
    }
  }

}

