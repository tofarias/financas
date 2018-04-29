<?php

$app->get('/users', function() use ($app){

    $repository = $app->service('user.repository');
    $users = $repository->all();

    $view = $app->service('view.renderer');
    return $view->render('users/list.html.twig', compact('users'));
}, 'users.list');

$app->get('/users/new', function() use ($app){

    $view = $app->service('view.renderer');
    return $view->render('users/create.html.twig');
}, 'users.new');

$app->post('/users/store', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $data = $request->getParsedBody();

    $repository = $app->service('user.repository');
    $repository->create( $data );

    return $app->route('users.list');
}, 'users.store');

$app->get('/users/{id}/edit', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $repository = $app->service('user.repository');
    $user = $repository->find( $request->getAttribute('id') );

    $view = $app->service('view.renderer');
    return $view->render('users/edit.html.twig', compact('user'));
}, 'users.edit');

$app->post('/users/{id}/update', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $id = $request->getAttribute('id');

    $repository = $app->service('user.repository');
    $user = $repository->find( $id );
    $data = $request->getParsedBody();
    $user->fill($data);
    $user->save();

    return $app->route('users.list');
}, 'users.update');

$app->get('/users/{id}/show', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $id = $request->getAttribute('id');

    $repository = $app->service('user.repository');
    $user = $repository->find( $id );

    $view = $app->service('view.renderer');
    return $view->render('users/show.html.twig', compact('user'));
}, 'users.show');

$app->get('/users/{id}/delete', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $id = $request->getAttribute('id');

    $repository = $app->service('user.repository');
    $repository->delete($id);

    return $app->route('users.list');
}, 'users.delete');