<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'deadline',
        'status',
        // 'priority', // add this if you included it in migration
    ];

    protected $casts = [
        'deadline' => 'date', // now deadline is a Carbon instance
    ];
    /**
     * Each task belongs to a user (staff).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
