<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\lesson;
use App\Models\Announcement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'first_name',
        'last_name',
        'middle_initial',
        'age',
        'student_No',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function students()
    {
        return $this->belongsToMany(User::class, 'teacher_student', 'teacher_id', 'student_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_student', 'student_id', 'teacher_id');
    }

    public function announcements(){
        return $this->hasMany(Announcement::class);
    }

    public function lessons(){
        return $this->hasMany(lesson::class, 'teacher_id');
    }
}
