<?php


namespace App\services;


use App\Post;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Collection;

class postService
{
    private $postRepository;


    public function __construct()
    {
        $this->postRepository = app(PostsRepository::class);
    }

    public function createPost( $data, Post $post)
    {

        $fields = $data->except('tags');
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
            $tags = $data->only('tags');
            if (isset($tags))
                $tags = explode(',', $tags['tags']);
            foreach ($tags as $tag) {
                    $this->postRepository->attachTag($id, $tag);
                }

        }

        return true;
    }

    public function updatePost($data, Post $post)
    {
        $fields = $data->except('tags');
        unset($fields['image']);
        $fields['slug'] = Str::snake($fields['name']);
        if ($data->has('image'))
        {
            Storage::delete($post->image);
            $imageName = time().'.'.$data->get('image')->extension();
            $path =  'images/'.$imageName;
            $fields['image'] = $path;
        }
       if ( $this->postRepository->updatePost($fields->toArray(), $post) && isset($imageName))
       {
           $data->get('image')->move(storage_path() . '/app/public/images', $imageName);
       }
        $tags = $data->only('tags');
        if (isset($tags))
        {
            $post->tags()->detach();
            $tags = preg_split('/[,\s]+/', $tags['tags'], -1, PREG_SPLIT_NO_EMPTY);

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
