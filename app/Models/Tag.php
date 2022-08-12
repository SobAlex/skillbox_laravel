<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function News()
    {
        return $this->belongsToMany(News::class);
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
