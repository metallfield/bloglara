<?php


namespace App\Repositories;


use App\Post;
use App\Tag;

class PostsRepository
{


    public function getAllPosts()
    {
        return Post::get();
    }

    public function getPostById($id)
    {
         return Post::where('id', $id)->findOrFail($id);
    }

    public function getTagsForSelect()
    {
        return Tag::select('id', 'name')->get();
    }
}
