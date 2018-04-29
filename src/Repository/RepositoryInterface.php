<?php
declare(strict_types=1);
namespace Fin\Repository;


interface RepositoryInterface
{
    public function all() : Array;

    public function find(int $id);

    public function create(Array $data);

    public function update(int $id, Array $data);

    public function delete(int $id);
}