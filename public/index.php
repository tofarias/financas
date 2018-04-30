<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/helpers.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );
$app->plugin( new \Fin\Plugins\ViewPlugin() );
$app->plugin( new \Fin\Plugins\DbPlugin() );
$app->plugin( new \Fin\Plugins\AuthPlugin() );

$app->get('/home/{name}/{id}', function(\Psr\Http\Message\RequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write('response do Diactoros');
    return $response;
});

require_once __DIR__.'/../src/controllers/category-costs.php';
require_once __DIR__.'/../src/controllers/bill-receives.php';
require_once __DIR__.'/../src/controllers/users.php';
require_once __DIR__.'/../src/controllers/auth.php';

$app->start();
