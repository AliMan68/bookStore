<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translator extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
      'title',
      'description'
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
