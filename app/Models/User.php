<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function uploaded_tasks()
    {
        return $this->hasMany(Task::class, 'id_uploader', 'id');
    }

    public function booked_tasks()
    {
        return $this->belongsToMany(Task::class, 'bookings', 'id_user', 'id_task')->withPivot('booked_at');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y M d');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y M d');
    }
}
