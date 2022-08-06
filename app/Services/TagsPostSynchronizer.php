<?php

namespace App\Services;

use App\Tag;
use App\Post;
use Illuminate\Support\Collection;

class TagsPostSynchronizer
{
    public function sync(Collection $tags, Post $post)
    {
        $postTags = $post->tags->keyBy('name');

        $tags = $tags->keyBy(function ($item) {
            return $item;
        });
        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();
        $tagsToAttatch = $tags->diffKeys($postTags);
        foreach ($tagsToAttatch as $tag) {
            $tag = Tag::firstOrCreate(['name' => trim($tag)]);
            $syncIds[] = $tag->id;
        }
        $post->tags()->sync($syncIds);
    }
}
