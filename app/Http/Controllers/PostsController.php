<?php

namespace App\Http\Controllers;

use App\Post;
use App\services\postService;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use Illuminate\Routing\Route;
use phpDocumentor\Reflection\Types\Collection;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private  $postService;
    public function __construct(postService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {

        $posts = $this->postService->getAllPosts();
        return view('blog.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->postService->getTagsForSelect();
        return view('blog.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $data = collect($request->all());
        $result =  $this->postService->createPost($data,  $post);
        if ($result)
        {
            return redirect()->route('admin_posts');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $tags = $this->postService->getTagsForSelect();
        return view('blog.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = collect($request->all());
        $result = $this->postService->updatePost($data, $post);
        if ($result)
        {
            return redirect()->route('admin_posts');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       if ($post->delete())
       {
           return redirect()->route('admin_posts');
       }

    }
}
