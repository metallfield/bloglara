<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['name','slug', 'content'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function store($params, $tags)
    {
        $fields = $params;
        $id = Post::create($fields)->id;
        if (isset($tags))
            foreach ($tags as $tagName => $tagId) {
                if ($tagId !== null){
                    self::find($id)->tags()->attach($tagId);
                }
            }
           return true;

     }
}
