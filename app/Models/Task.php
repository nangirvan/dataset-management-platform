<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_uploader',
        'name',
        'file_path',
        'file_size',
        'uploaded_at',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'id_uploader', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings', 'id_task', 'id_user')->withPivot('booked_at');
    }
}
