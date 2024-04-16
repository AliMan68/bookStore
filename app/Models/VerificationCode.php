<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificationCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['mobile', 'code', 'token', 'is_verified', 'expired_at'];


    const CODE_EXPIRE_DURATION = 4;//minutes
    const TOKEN_EXPIRE_DURATION = 30;//minutes

    public static function generateCode($mobile){
        $vc = new VerificationCode();
        $vc->mobile = $mobile;
        $vc->code = getRandomNumber(6);
        $feed = date('Y-m-d H:i:s') . '-' . $mobile;
        $vc->token = \MyCrypt::encrypt($feed);
        $vc->is_verified = 0;
        $dateTime = new DateTime(date('Y-m-d H:i:s'));
        $dateTime->add(new DateInterval('PT' . self::CODE_EXPIRE_DURATION . 'M'));
        $time = $dateTime->format('Y-m-d H:i:s');
        $vc->expired_at = $time;
        $vc->save();
        return $vc;
    }

    public static function validateCode($mobile, $code){
        $now = date('Y-m-d H:i:s');
        $vc = VerificationCode::where('mobile', '=', $mobile)->where('code', '=', $code)->where('expired_at', '>=', $now)->where('is_verified', '=', 0)->first();
        if ($vc == null)
            return false;

        $vc->is_verified = 1;
        $vc->save();
        return true;
    }


//  public function expireToken(){
//    $now = date('Y-m-d H:i:s');
//    $obj = json_decode(MCrypt::decrypt($this->token));
//    $obj->token_status = 'expired';
//    $obj->token_expired_at =  $now;
//    $this->token = MCrypt::encrypt(json_encode($obj));
//    $this->save();
//  }



    public static function validateToken($token, $mobile){
        $vc = VerificationCode::where('mobile', '=', $mobile)->where('token', '=', $token)->where('is_verified', '=', 1)->first();
        if ($vc == null)
            return false;
        return true;
    }

}
