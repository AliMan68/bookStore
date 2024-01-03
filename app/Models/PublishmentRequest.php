<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishmentRequest extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'request_number',
        'request_date',
        'attachment',
        'total_amount',
    ];
    protected $table = 'publish_request';

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
