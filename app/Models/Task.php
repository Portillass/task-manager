<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'created_by',
        'priority',
        'status',
        'due_date',
        'completed_at',
    ];

    // Add this casts property
    protected $casts = [
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationship to assigned user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
