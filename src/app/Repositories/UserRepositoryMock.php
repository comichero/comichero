<?php


namespace App\Repositories;

use App\User;

class UserRepositoryMock implements UserRepository
{
    public function create(string $name, string $email, string $password): User
    {
        return (new User())->fill(compact('name', 'email', 'password'));
    }
}
