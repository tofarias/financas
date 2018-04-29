<?php

$app->get('/login', function() use ($app){

    $view = $app->service('view.renderer');
    return $view->render('auth/login.html.twig');
}, 'auth.show_login_form');

$app->post('/login', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $app->service('auth')->login();

    /*$data = $request->getParsedBody();

    $repository = $app->service('user.repository');
    $repository->create( $data );

    return $app->route('users.list');*/
}, 'auth.login');