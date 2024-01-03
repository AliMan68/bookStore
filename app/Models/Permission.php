<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','description'];
    protected $table ='permissions';

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

}
