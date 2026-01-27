<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;  // Keep this for factory support (optional but recommended)

    protected $fillable = [
        'user_id',
        'skin_type',
        'concerns',
        'age',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}