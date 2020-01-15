<?php


namespace App\Services;


use App\Repositories\UserRepository;
use App\User;

class UserServiceImpl implements UserService
{
    private UserRepository $userRepository;

    /**
     * UserServiceImpl constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(string $name, string $email, string $password): User
    {
        return $this->userRepository->create($name, $email, $password);
    }
}
