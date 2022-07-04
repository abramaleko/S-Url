<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urls extends Model
{
    use HasFactory,SoftDeletes;

    protected $casts = [
        'expires_on' => 'datetime:Y-m-d',
    ];

    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }

}
