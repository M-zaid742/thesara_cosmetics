<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> 4d098648327f2f41bb48ccab51ac6506b000600f

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

     public function setPasswordAttribute($value)
    {
        // Only hash if not already hashed
        if (!preg_match('/^\$2y\$/', $value)) {
            $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
        } else {
            $this->attributes['password'] = $value;
        }
    }



    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

    public function skinAnalyses() {
        return $this->hasMany(SkinAnalysis::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
 

}
