<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory;

    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addStep($attributes)
    {
        return $this->steps()->create($attributes);
    }
}
