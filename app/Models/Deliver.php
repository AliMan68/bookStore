<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliver extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'transferee',
        'deliver_date',
        'attachment'
    ];

    public function books(){
        //->withPivot() - get extra columns info with this
        return $this->belongsToMany(Book::class)->withPivot('count','minus_stock');;
    }
}
