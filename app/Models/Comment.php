<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'parent_id',
        'commentable_id',
        'commentable_type',
        'approved',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentable(){
        return $this->morphTo();
    }

    //use when you have ability to response to comment(parent and child)
    public function child(){
        return $this->hasMany(Comment::class,'parent_id','id');
    }


}
