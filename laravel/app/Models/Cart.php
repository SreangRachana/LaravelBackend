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
    protected function cartDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value)=> Carbon::createFromFormat("d/m/Y H:i;s", $value)->format("Y-m-d H:i:s"),
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H;i:s'),

        );
    }

}
