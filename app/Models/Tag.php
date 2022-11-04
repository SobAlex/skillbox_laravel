<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function News()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function Tasks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsPostsCloud()
    {
        return (new static)->Has('posts')->get();
    }

    public static function tagsNewsCloud()
    {
        return (new static)->Has('news')->get();
    }


}
