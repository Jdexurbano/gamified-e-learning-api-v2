<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'description',
        'code',
        'is_open'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
