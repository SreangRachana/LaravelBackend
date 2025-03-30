<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = ["quantity","customer_id","product_id"];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
