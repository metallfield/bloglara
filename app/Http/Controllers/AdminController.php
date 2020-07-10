<?php


namespace App\Http\Controllers;


use App\Repositories\PostsRepository;
use App\Repositories\TagsRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function posts(Request $request, PostsRepository $postsRepository)
    {
        $posts = $postsRepository->getAllPosts($request->user());
        return view('admin.posts', compact('posts'));
    }

    public function tags(TagsRepository $tagsRepository)
    {
        $tags = $tagsRepository->getTagsForAdmin();
        return view('admin.tags', compact('tags'));
    }
}
