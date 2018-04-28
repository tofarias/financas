<?php

require_once __DIR__.'/../vendor/autoload.php';

$serviceContainer = new \Fin\ServiceContainer();
$app = new \Fin\Application( $serviceContainer );

$app->plugin( new \Fin\Plugins\RoutePlugin() );

$app->get('/', function(){
    echo 'Ok';
});

$app->get('/home', function(){
    echo 'Home';
});

$app->start();