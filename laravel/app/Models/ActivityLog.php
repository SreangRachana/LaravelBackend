<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use SoftDeletes;
    protected $fillable = ['model', 'model_id', 'action', 'changes'];
    protected $casts = ['changes' =>'array'];
    public $timestamps = false;
}
