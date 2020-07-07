<?php


namespace App\Http\Controllers;


use App\Repositories\PostsRepository;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{

    public function posts(PostsRepository $postsRepository)
    {
        $posts = $postsRepository->getAllPosts();
        return view('admin.posts', compact('posts'));
    }
}
