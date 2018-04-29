<?php

declare(strict_types=1);

namespace Fin\Repository;


class DefaultRepository implements RepositoryInterface
{
    private $modelClass;
    private $model;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        $this->model      = new $modelClass;
    }

    public function all(): Array
    {
        return $this->model->all()->toArray();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(Array $data)
    {
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }

    public function update(int $id, Array $data)
    {
        $model = $this->find( $id );
        $model->fill( $data );
        $model->save();
        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->model->find( $id );
        $model->delete();
    }
}