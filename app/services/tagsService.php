<?php


namespace App\services;


use App\Repositories\TagsRepository;
use App\Tag;
use Illuminate\Support\Str;

class tagsService
{
    private $tagsRepository;
    public function __construct()
    {
        $this->tagsRepository = app(TagsRepository::class);
    }

    public function createTag($data)
    {
        $data['slug'] = Str::snake($data['name']);
        return $this->tagsRepository->create($data);
    }
    public function getTagsForIndex()
    {
        return $this->tagsRepository->getTagsForIndex();
    }

    public function updateTag($data, Tag $tag)
    {
        $data['slug'] = Str::snake($data['name']);
        return $this->tagsRepository->update($data, $tag);
    }
}
