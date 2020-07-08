<?php


namespace App\Repositories;


use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsRepository
{


    public function getAllPosts()
    {
        return Post::with('tags')->get();
    }

    public function getPostById($id)
    {
         return Post::where('id', $id)->findOrFail($id);
    }

    public function getTagsForSelect()
    {
        return Tag::select('id', 'name')->get();
    }

    public function storePost(Request $request, Post $post)
    {
        $fields = $request->except('tags');
        unset($fields['image']);
        if ($request->has('image'))
        {
            $path =  $request->file('image')->store('images');
            $fields['image'] = $path;
        }

        $id = Post::create($fields)->id;
        $tags = $request->only('tags');
        if (isset($tags))
            foreach ($tags as $tagName => $tagId) {
                if ($tagId !== null){
                    Post::find($id)->tags()->attach($tagId);
                }
            }
        return true;
    }

    public function updatePost(Request $request, Post $post)
    {
        $fields = $request->except('tags');
        $post->update($fields);
        $selectFields = $request->only('tags');
        if (isset($selectFields))
        {
            $post->tags()->detach();
            foreach ($selectFields as $k => $v)
            {
                $post->tags()->attach($v);
            }
        }
        return true;
    }
}
