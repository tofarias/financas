<?php

namespace Fin\Auth;


use Fin\Repository\RepositoryInterface;
use Jasny\Auth\Sessions;
use Jasny\Auth\User;

class JasnyAuth extends \Jasny\Auth
{
    use Sessions;

    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch a user by ID
     *
     * @param  int|string $id
     * @return User|null
     */
    public function fetchUserById($id)
    {
        return $this->repository->find($id, false);
    }

    /**
     * Fetch a user by username
     *
     * @param  string $username
     * @return User|null
     */
    public function fetchUserByUsername($username)
    {
        return $this->repository->findByField('email', $username)->first();
    }
}