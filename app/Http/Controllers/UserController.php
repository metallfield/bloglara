<?php

namespace App\Http\Controllers;

use App\services\userService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $this->userService->getPostsByUser($user);
        $author = $user->name;
        return view('users.show', compact('posts', 'author'));
    }


}
