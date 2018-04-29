<?php

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

$app->get('/category-costs/{id}/edit', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $view = $app->service('view.renderer');


    $categoryCosts = new \Fin\Models\CategoryCosts();
    $category = $categoryCosts->findOrFail( $request->getAttribute('id') );

    return $view->render('category-costs/edit.html.twig', compact('category'));
}, 'category-costs.edit');

$app->post('/category-costs/{id}/update', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $id = $request->getAttribute('id');

    $categoryCosts = new \Fin\Models\CategoryCosts();
    $category = $categoryCosts->findOrFail( $id );
    $data = $request->getParsedBody();
    $category->fill($data);
    $category->save();

    return $app->route('category-costs.list');
}, 'category-costs.update');

$app->get('/category-costs/{id}/show', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){

    $view = $app->service('view.renderer');
    $id = $request->getAttribute('id');
    #die($id);
    $categoryCosts = new \Fin\Models\CategoryCosts();
    $category = $categoryCosts->findOrFail( $id );

    return $view->render('category-costs/show.html.twig', compact('category'));
}, 'category-costs.show');

$app->get('/category-costs/{id}/delete', function(\Psr\Http\Message\ServerRequestInterface $request) use ($app){


    $id = $request->getAttribute('id');
    $categoryCosts = new \Fin\Models\CategoryCosts();
    $category = $categoryCosts->findOrFail( $id );
    $category->delete();

    return $app->route('category-costs.list');
}, 'category-costs.delete');