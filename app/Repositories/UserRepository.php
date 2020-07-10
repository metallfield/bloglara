<?php


namespace App\Repositories;


use App\Post;
use App\User;

class UserRepository
{

    public function getAllUsers()
    {
        return User::select('name', 'id')->get();
    }

    public function getPostsByUser(User $user)
    {
        return Post::with('user')->where('user_id', $user->id)->paginate(6  );
    }
}
