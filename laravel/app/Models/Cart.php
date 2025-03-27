<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Cart extends Model
{
    protected $fillable = ["quantity","customer_id","product_id"];
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
