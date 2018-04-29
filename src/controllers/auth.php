<?php

$app->get('/login', function() use ($app){

    $view = $app->service('view.renderer');
    return $view->render('auth/login.html.twig');
}, 'auth.show_login_form');

$app->post('/login', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $view = $app->service('view.renderer');
    $auth = $app->service('auth');

    $data = $request->getParsedBody();

    $result = $auth->login($data);

    if( !$result ){
        return $view->render('auth/login.html.twig');
    }

    return $app->route('category-costs.list');
}, 'auth.login');