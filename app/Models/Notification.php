<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $casts = [
        'read' => 'boolean',
        'read_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'data',
        'read',
        'read_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}