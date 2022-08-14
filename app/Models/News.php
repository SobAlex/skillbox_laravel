<?php

namespace App\Models;

use App\Events\NewsCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RevisionableTrait;

    public $fillable = ['owner_id', 'title', 'content', 'image', 'isPublick'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentNews::class);
    }
}
