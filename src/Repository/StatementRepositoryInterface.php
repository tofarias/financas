<?php
declare(strict_types=1);
namespace Fin\Repository;


interface StatementRepositoryInterface
{
    public function all(string $dateStart, string $dateEnd, int $userId) : Array;
}