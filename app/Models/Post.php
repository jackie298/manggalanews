<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function breakingNews()
    {
        return $this->hasOne(BreakingNews::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
