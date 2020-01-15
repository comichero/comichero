<?php


namespace App\Repositories;


use App\User;

interface UserRepository
{
    public function create(string $name, string $email, string $password): User;
}
