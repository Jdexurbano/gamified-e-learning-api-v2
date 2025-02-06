<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title','description'
    ];  

    public function users(){
        return $this->belongsTo(User::class);
    }
}
