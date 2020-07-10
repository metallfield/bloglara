<?php


namespace App\Repositories;


use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsRepository
{


    public function getAllPosts(?User $user = null)
    {
        $query = Post::with('tags', 'user')->orderBy('updated_at', 'desc');
        if($user !== null) {
            $query->where('user_id', $user->id);
        }
        return $query->paginate(6);
    }

    public function getPostById($id)
    {
         return Post::where('id', $id)->findOrFail($id);
    }

    public function getTagsForSelect()
    {
        return Tag::select('id', 'name')->get();
    }

    public function storePost($fields, Post $post)
    {


       $id = $post->create($fields)->id;
       if ($id)
       {
           return $id;
       }else{
           return null;
       }
    }

    public function attachTag($id, $tag)
    {
       $tagID = Tag::where('name', $tag)->select('id')->first();

        if (isset($tagID))
        {
            Post::find($id)->tags()->attach($tagID);

        }else{
            $tagArr['name'] = $tag;
            $tagArr['slug'] = Str::snake($tag);
            $tagID = Tag::create($tagArr)->id;
            Post::find($id)->tags()->attach($tagID);
        }

    }

    public function updatePost($fields, Post $post)
    {
           if ( $post->update($fields))
           {
               return true;
           }
           else{
               return false;
           }
    }
}
