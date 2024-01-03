<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'parent',
    ];
    public function books(){
        return $this->belongsToMany(Book::class);
    }

    //use this function when our category has N level.in blade user @include('some.view',['categories'=>$categories])
    //use this template any where
    public function child(){
        return $this->hasMany(Category::class,'parent','id');
    }
}
