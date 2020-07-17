<?php


namespace App\Repositories;


use App\Tag;

class TagsRepository
{

    public function create($data)
    {
        return Tag::create($data);
    }

    public function getTagsForIndex()
    {
        return Tag::select('id', 'name')->get();
    }
    public function getTagsForAdmin()
    {
        return Tag::get();
    }

    public function update($data, Tag $tag)
    {
        return $tag->update($data);
    }
}
