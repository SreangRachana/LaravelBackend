<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    // Allow mass assignment
    protected $fillable = ['name'];

    public function products(){
        return $this->hasMany(Product::class);
    }

}
