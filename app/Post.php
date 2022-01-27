<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

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
