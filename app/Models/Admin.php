<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins'; // make sure your table is named admins

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Optional: auto-hash passwords on create/update
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = \Hash::make($value);
        }
    }
}
