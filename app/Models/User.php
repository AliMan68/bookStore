<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'is_admin',
        'is_staff',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin(){
        return $this->is_admin;
    }
    public function isStaff(){
        return $this->is_staff;
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission){
        //in first part we check if user have permission
        //in second part we check roles of permission and compare it to user roles
//        dd($permission->roles);
        return !! $this->permissions->contains('title',$permission->title) || $this->hasRole($permission->roles);
    }

    public function hasRole($roles){
//        dd($roles[0]->title);
        //in this method we check if we have any common item between user roles and roles of given permissions
//        if ($roles->count() == 1){
//            return !! $this->roles->contains('title',$roles[0]->title);
//        }else{
            return !! $this->roles->intersect($roles)->all();
//        }
    }

}
