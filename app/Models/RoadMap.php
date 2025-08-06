<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'photo',
        'description',
        'details',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
