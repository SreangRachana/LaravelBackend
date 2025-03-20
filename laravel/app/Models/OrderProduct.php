<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class OrderProduct extends Model
{
    protected $fillable = ["order_id","product_id","price","quantity"];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    protected function orderDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value)=> Carbon::createFromFormat("d/m/Y H:i;s", $value)->format("Y-m-d H:i:s"),
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H;i:s'),

        );
    }
}
