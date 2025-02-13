<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    protected $fillable = ['title', 'youtube_link', 'is_open','teacher_id',];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
