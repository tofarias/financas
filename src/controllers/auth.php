<?php

$app->get(
    '/login', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('auth/login.html.twig');
    }, 'auth.show_login_form'
);

$app->get(
    '/logout', function () use ($app) {

        $auth = $app->service('auth')->logout();

        return $app->route('auth.show_login_form');
    }, 'auth.logout'
);

$app->post(
    '/login', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        $auth = $app->service('auth');

        $data = $request->getParsedBody();

        $result = $auth->login($data);

        if(!$result ) {
            return $view->render('auth/login.html.twig');
        }

        return $app->route('category-costs.list');
    }, 'auth.login'
);

$app->before(
    function () use ($app) {

        $route = $app->service('route');
        $auth = $app->service('auth');
        $routeWhiteList = [
        'auth.show_login_form',
        'auth.login'
        ];

        if(!in_array($route->name, $routeWhiteList) && !$auth->check() ) {
            return $app->route('auth.show_login_form');
        }
    }
);