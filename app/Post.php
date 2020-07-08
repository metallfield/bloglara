<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    protected $fillable = ['name','slug', 'content', 'image'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
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
