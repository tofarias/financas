<?php
declare(strict_types=1);
namespace Fin\Repository;


interface RepositoryInterface
{
    public function all() : Array;

    public function find(int $id, bool $failIfNotExists = true);

    public function findByField(string $field, $value);

    public function create(Array $data);

    public function update(int $id, Array $data);

    public function delete(int $id);
}