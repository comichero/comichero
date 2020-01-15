<?php

namespace Tests\Unit;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryMock;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        app()->bind(UserRepository::class, UserRepositoryMock::class);

        $this->userService = app()->make(UserServiceImpl::class);
    }

    /**
     * Check if the user is created
     *
     * @return void
     */
    public function testUserIsCreated()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => '33123'
        ];

        $user = $this->userService->create(...array_values($data));

        $this->assertEquals($data['name'], $user->name, 'Name does not match');
        $this->assertEquals($data['email'], $user->email, 'Email address does not match');
        $this->assertTrue(Hash::check($data['password'], $user->password), 'Password hash is not valid');
    }
}
