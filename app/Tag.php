<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $guarded = [];

    public function Tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        return (new static)->Has('posts')->get();
    }
}
