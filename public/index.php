<?php

require_once __DIR__.'/../vendor/autoload.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );
$app->plugin( new \Fin\Plugins\ViewPlugin() );
$app->plugin( new \Fin\Plugins\DbPlugin() );

$app->get('/home/{name}/{id}', function(\Psr\Http\Message\RequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write('response do Diactoros');
    return $response;
});

$app->get('/category-costs', function() use ($app){

    $categoryCosts = new \Fin\Models\CategoryCosts();
    $categories = $categoryCosts->all();

    $view = $app->service('view.renderer');
    return $view->render('category-costs/list.html.twig', compact('categories'));
}, 'category-costs.list');

$app->get('/category-costs/new', function() use ($app){

    $view = $app->service('view.renderer');
    return $view->render('category-costs/create.html.twig');
}, 'category-costs.new');

$app->post('/category-costs/store', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $data = $request->getParsedBody();

    \Fin\Models\CategoryCosts::create( $data );

    return $app->route('category-costs.list');
}, 'category-costs.store');

$app->start();
