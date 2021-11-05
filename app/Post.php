<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = ['owner_id', 'title', 'content', 'shortContent', 'code', 'isPublick'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
