<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;
    protected $table = 'active_code';
    protected $fillable=[
        'user_id',
        'code',
        'expire_at',
    ];
    //when we don not use timestams in our migration
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($user){
        //check if we have active code "expire_at"
        //generate new code until user and code are Unique
//        $user = auth()->user();
        if ($code = self::getAliveCodeForUser($user)){
            $code = $code->code;
        }else{
            do{
                $code = rand(100000,999999);
            }while(self::isCodeUnique($user,$code));
            $user->activeCode()->create([
                'code'=>$code,
                'expire_at'=> now()->addMinutes(10),
            ]);
        }

        return $code;
    }
    private function isCodeUnique($user,$code){
        return !! $user->activeCode()->where('code',$code)->first();
    }
    private function getAliveCodeForUser($user){
        return $user->activeCode()->where('expire_at','>',now())->first();
    }

    public function scopeValidateCode($user,$code){
        return !! $user->activeCode()->where('code','=',$code)->where('expire_at','>',now())->first();
    }

}
