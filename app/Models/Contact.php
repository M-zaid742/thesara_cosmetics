<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read'
    ];
}