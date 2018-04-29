<?php

declare(strict_types=1);
namespace Fin\Auth;


use Fin\Models\UserInterface;

interface AuthInterface
{
    public function login(Array $credentials) : bool;

    public function check() : bool;

    public function logout() : void;

    public function hashPassword(string $password) : string;

    public function user() : ?UserInterface;
}