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

    public function find(int $id, bool $failIfNotExists = true)
    {
        return $failIfNotExists ? $this->model->findOrFail($id) : $this->model->find($id);
    }

    public function create(Array $data)
    {
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }

    public function update($id, Array $data)
    {
        $model = $this->findInternal($id);

        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findInternal($id);
        $model->delete();
    }

    public function findByField(string $field, $value)
    {
        return $this->model
            ->where($field, '=', $value)
            ->get();
    }

    public function findOneBy(Array $search)
    {
        $queryBuilder = $this->model;
        foreach($search as $field => $value)
        {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        return $queryBuilder->firstOrFail();
    }

    protected function findInternal($id)
    {
        return is_array($id) ? $this->findOneBy($id) : $this->find($id);
    }
}