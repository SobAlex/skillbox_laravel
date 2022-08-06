<?php

namespace App\Services;

use App\Tag;
use App\News;
use Illuminate\Support\Collection;

class TagsNewsSynchronizer
{
    public function sync(Collection $tags, News $news)
    {
        $newsTags = $news->tags->keyBy('name');

        $tags = $tags->keyBy(function ($item) {
            return $item;
        });
        $syncIds = $newsTags->intersectByKeys($tags)->pluck('id')->toArray();
        $tagsToAttatch = $tags->diffKeys($newsTags);
        foreach ($tagsToAttatch as $tag) {
            $tag = Tag::firstOrCreate(['name' => trim($tag)]);
            $syncIds[] = $tag->id;
        }
        $news->tags()->sync($syncIds);
    }
}
