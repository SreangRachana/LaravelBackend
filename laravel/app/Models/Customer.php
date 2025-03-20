<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Customer extends Model
{
    protected $fillable = ["name"."email","address","phone"];
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function products(){
        return $this->hasManyThrough(Product::class, Cart::class);
    }
    protected function cartDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value)=> Carbon::createFromFormat("d/m/Y H:i;s", $value)->format("Y-m-d H:i:s"),
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H;i:s'),

        );
    }
}
