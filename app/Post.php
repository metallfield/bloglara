<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    protected $fillable = ['name','slug', 'content', 'image', 'user_id'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function selectedTag($id)
    {
        $tagsArr = [];
        foreach ($this->tags as $tag)
        {
            $tagsArr[] = $tag->id;
        }
        if (in_array($id, $tagsArr) )
        {
            return 'selected';
        }
    }

}
