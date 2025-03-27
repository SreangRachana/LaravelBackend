<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Category extends Model
{
    // Allow mass assignment
    protected $fillable = ['name'];

    public function product(){
        return $this->hasMany(Product::class);
    }
    
}
