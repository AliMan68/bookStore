<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
      'price',
      'status',
      'receiver_name',
      'receiver_number',
      'receiver_state',
      'receiver_city',
      'receiver_postal_code',
      'receiver_address',
      'delivery_type',
      'tracking_code',
      'discount_code_id',
    ];

    public function discountCode(){
        return $this->hasOne(DiscountCode::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function books(){
        return $this->belongsToMany(Book::class)->withPivot('quantity','price');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
