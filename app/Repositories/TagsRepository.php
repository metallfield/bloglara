<?php


namespace App\Repositories;


use App\Tag;

class TagsRepository
{

    public function getTagsForIndex()
    {
        return Tag::select('id', 'name')->get();
    }
    public function getTagsForAdmin()
    {
        return Tag::get();
    }


}
