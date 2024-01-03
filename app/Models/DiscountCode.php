<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
      'code',
      'percent'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
