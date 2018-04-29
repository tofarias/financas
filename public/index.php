<?php

require_once __DIR__.'/../vendor/autoload.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );
$app->plugin( new \Fin\Plugins\ViewPlugin() );

$app->get('/{name}', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig',['name' => $request->getAttribute('name')]);
});

$app->get('/home/{name}/{id}', function(\Psr\Http\Message\RequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write('response do Diactoros');
    return $response;
});

$app->start();
