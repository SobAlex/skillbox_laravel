<?php

namespace App;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    public $fillable = ['owner_id', 'title', 'content', 'shortContent', 'code', 'isPublick'];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
