<?php

require_once __DIR__.'/../vendor/autoload.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );

$app->get('/', function(Psr\Http\Message\RequestInterface $request){
    var_dump( $request->getUri() );
    echo 'Ok';
});

$app->get('/home/{name}/{id}', function(Psr\Http\Message\RequestInterface $request){
    echo 'Home';
    echo "<br>";
    echo $request->getAttribute('name');
    echo "<br>";
    echo $request->getAttribute('id');
});

$app->start();
