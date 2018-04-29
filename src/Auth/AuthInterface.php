<?php

declare(strict_types=1);
namespace Fin\Auth;


interface AuthInterface
{
    public function login(Array $credentials) : bool;

    public function check() : bool;

    public function logout() : void;
}