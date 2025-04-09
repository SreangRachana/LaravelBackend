<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    // Allow for mass assignment
    protected $fillable = ['name', 'pricing', 'category_id', 'description', 'image'];

    public function category(){
        return $this->belongsTo(related: Category::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }
    public function order_products(){
        return $this->hasMany(OrderProduct::class);
    }

}
