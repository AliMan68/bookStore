<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherSales extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'sale_title',
        'deliver_date',
        'attachment'
    ];

    public function books(){
        //->withPivot() - get extra columns info with this
        return $this->belongsToMany(Book::class)->withPivot('count','minus_stock','total_amount');;
    }
}
