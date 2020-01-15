<?php


namespace App\Services;


use App\User;

interface UserService
{
    public function create(string $name, string $email, string $password): User;
}
