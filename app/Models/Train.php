<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $table = 'train';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Categories::class);
    }
}
