<?php


namespace App\services;


use App\Post;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Collection;

class postService
{
    /** @var PostsRepository */
    private $postRepository;


    public function __construct()
    {
        $this->postRepository = app(PostsRepository::class);
    }

    public function createPost( $data, Post $post)
    {
        $fields = $data->except('tags');
        $fields['user_id'] = Auth::id();
        unset($fields['image']);
        $fields['slug'] = Str::snake($fields['name']);
        if ($data->has('image'))
        {
            $imageName = time().'.'.$data->get('image')->extension();
            $path =  'images/'.$imageName;
            $fields['image'] = $path;
        }
        $id = $this->postRepository->storePost($fields->toArray(), $post);
        if (!empty($id)){
            if (isset($imageName)) {
                $data->get('image')->move(storage_path() . '/app/public/images', $imageName);
            }
            $tags = $data->only('tag');
            if (isset($tags['tag']))
            {
                $tags = $tags['tag'];
                foreach ($tags as $tag) {
                    if ($tag != '') {
                        $this->postRepository->attachTag($id, $tag);
                    }
                }
            }


        }

        return true;
    }
    public function CheckAuthor($author_id)
    {
        if (Auth::id() == $author_id && $author_id != null)
        {
            return true;
        }
        return false;
    }
    public function updatePost($data, Post $post)
    {
        $fields = $data->except('tags');
        unset($fields['image']);
        $fields['slug'] = Str::snake($fields['name']);
        if ($data->has('image'))
        {
            Storage::delete($post->image);
            $imageName = uniqid().'_'.$data->get('image')->getClientOriginalName();
            $path =  'images/'.$imageName;
            $fields['image'] = $path;
        }
        if ( $this->postRepository->updatePost($fields->toArray(), $post) && isset($imageName))
        {
            $data->get('image')->move(storage_path() . '/app/public/images', $imageName);
        }
        $tags = $data->only('tag');
        if (isset($tags['tag']))
        {

            $post->tags()->detach();
            $tags = $tags['tag'];

            foreach ($tags as $tag)
            {

                if ($tag != '') {

                    $this->postRepository->attachTag($post->id, $tag);
                }

            }
        }
        return true;
    }
    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }
    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function getTagsForSelect()
    {
        return $this->postRepository->getTagsForSelect();
    }

}
