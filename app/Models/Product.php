<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * (Match these with your database columns)
     */
    protected $fillable = [
        'name',
        'subtitle',
        'slug',
        'description',
        'price',
        'cost_price',
        'old_price',
        'is_featured',
        'stock',
        'category',
        'badge',
        'brand',
        'image_url'
    ];

    /**
     * 🔗 Relationship: A product can have many additional images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * 🔗 Relationship: A product can have many reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * 🔗 Relationship: A product can appear in many carts
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * 🔗 Relationship: A product can be part of many orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 🔗 Relationship: A product can be added to many wishlists
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
