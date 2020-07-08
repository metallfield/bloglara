<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use Illuminate\Routing\Route;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private  $postRepository;
    public function __construct(PostsRepository $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function index()
    {

        $posts = $this->postRepository->getAllPosts();
        return view('blog.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postRepository->getPostById($id);
        return view('blog.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->postRepository->getTagsForSelect();
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

      $result =  $this->postRepository->storePost($request, $post);

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
        $post = $this->postRepository->getPostById($id);
        $tags = $this->postRepository->getTagsForSelect();
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
        $result = $this->postRepository->updatePost($request, $post);
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
