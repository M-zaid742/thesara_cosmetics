<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'is_admin'];

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
