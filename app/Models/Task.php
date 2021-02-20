<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function getFileSizeAttribute($value)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($value, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow)); 

        return round($bytes, 2) . '' . $units[$pow]; 
    }

    public function getUploadedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
