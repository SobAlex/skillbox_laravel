<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentNews extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comments_news';
    protected $guarded = false;

    public function news() {
        return $this->belongsTo(News::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
