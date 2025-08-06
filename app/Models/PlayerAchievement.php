<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'count',
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
