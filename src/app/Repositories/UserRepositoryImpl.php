<?php


namespace App\Repositories;


use App\User;

class UserRepositoryImpl implements UserRepository
{
    public function create(string $name, string $email, string $password): User
    {
        return User::create(compact('name', 'email', 'password'));
    }
}
