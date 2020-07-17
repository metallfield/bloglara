<?php


namespace App\services;


use App\Repositories\UserRepository;
use App\User;

class userService
{

    public function __construct()
    {
        $this->UserRepository = app(UserRepository::class);
    }

    public function getAllUsers()
    {
        return $this->UserRepository->getAllUsers();
    }

    public function getPostsByUser(User $user)
    {
        return $this->UserRepository->getPostsByUser($user);
    }
}
