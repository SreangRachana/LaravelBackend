<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment-id','payment_method', 'amount', 'order_id', 'customer_id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    protected function paymentDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value)=> Carbon::createFromFormat("d/m/Y H:i;s", $value)->format("Y-m-d H:i:s"),
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y H;i:s'),

        );
    }
    
}
