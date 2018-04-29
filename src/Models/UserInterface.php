<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 29/04/18
 * Time: 17:52
 */

namespace Fin\Models;


interface UserInterface
{
    public function getId() : int;

    public function getFullname() : string;

    public function getEmail() : string;

    public function getPassword() : string;
}