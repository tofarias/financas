<?php

require_once __DIR__.'/../vendor/autoload.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );
$app->plugin( new \Fin\Plugins\ViewPlugin() );


$app->get('/home/{name}/{id}', function(\Psr\Http\Message\RequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write('response do Diactoros');
    return $response;
});

$app->get('/category-costs', function() use ($app){
    $view = $app->service('view.renderer');
    return $view->render('category-costs/list.html.twig');
});

$app->start();
