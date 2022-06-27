<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    use HasFactory;

    protected $fillable=[
        'redirect_to',
        'short_url'
    ];

    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }
}
