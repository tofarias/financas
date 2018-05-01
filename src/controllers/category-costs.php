<?php

$app->get(
    '/category-costs', function () use ($app) {

        $auth = $app->service('auth');

        $repository = $app->service('category-cost.repository');
        $categories = $repository->findByField('user_id', $auth->user()->getId());

        $view = $app->service('view.renderer');
        return $view->render('category-costs/list.html.twig', compact('categories'));
    }, 'category-costs.list'
);

$app->get(
    '/category-costs/new', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('category-costs/create.html.twig');
    }, 'category-costs.new'
);

$app->post(
    '/category-costs/store', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $data = $request->getParsedBody();
        $data['user_id'] = $auth->user()->getId();

        $repository = $app->service('category-cost.repository');
        $repository->create($data);

        return $app->route('category-costs.list');
    }, 'category-costs.store'
);

$app->get(
    '/category-costs/{id}/edit', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');
        $repository = $app->service('category-cost.repository');

        $id = $request->getAttribute('id');

        $category = $repository->findOneBy(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ] 
        );

        $view = $app->service('view.renderer');
        return $view->render('category-costs/edit.html.twig', compact('category'));
    }, 'category-costs.edit'
);

$app->post(
    '/category-costs/{id}/update', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        // $category = $repository->find( $id );

        $data = $request->getParsedBody();
        $data['user_id'] = $auth->user()->getId();

        $repository->update(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ], $data 
        );

        return $app->route('category-costs.list');
    }, 'category-costs.update'
);

$app->get(
    '/category-costs/{id}/show', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        $category = $repository->findOneBy(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ] 
        );

        $view = $app->service('view.renderer');
        return $view->render('category-costs/show.html.twig', compact('category'));
    }, 'category-costs.show'
);

$app->get(
    '/category-costs/{id}/delete', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');
        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        $repository->delete(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ]
        );

        return $app->route('category-costs.list');
    }, 'category-costs.delete'
);