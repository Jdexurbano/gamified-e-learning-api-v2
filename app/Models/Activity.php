<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
       'game','score','rating','student_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
