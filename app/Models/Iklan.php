<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'content', 'position', 'image', 'is_active'
    ];

    protected $table = 'iklans';
}
