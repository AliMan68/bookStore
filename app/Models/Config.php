<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['key', 'value'];
    protected $table = 'configs';


    public static function get($key){
        $result = Config::where('key', '=', $key)->orderBy('id', 'desc')->first();
        if (is_null($result)){
            $result = new Config();
        }
        $result->key = $key;
        return $result;
    }

    public static function getValue($key, $default = null){
        if (is_null(self::get($key)->value))
            return $default;
        return self::get($key)->value;
    }

    //################################## sms #############################################

    const KEY_SMS_COMPANY = 'sms-company';
    const KEY_SMS_IR = 'sms-ir';
    const KEY_SMS_IR_API_KEY = 'sms-ir-api-key';
    const KEY_SMS_IR_SECRET_KEY = 'sms-ir-secret-key';
    const KEY_SMS_IR_LINE_NUMBER = 'sms-ir-line-number';
    const KEY_SMS_IR_TEMPLATE_NUMBER = 'sms-ir-template-number';
    const KEY_SMS_FARAZ = 'sms-faraz';
    const KEY_SMS_FARAZ_USERNAME = 'sms-faraz-username';
    const KEY_SMS_FARAZ_PASSWORD = 'sms-faraz-password';
    const KEY_SMS_FARAZ_FROM_NUMBER = 'sms-faraz-from-number';
    const KEY_SMS_FARAZ_PATTERN_CODE = 'sms-faraz-pattern-code';
    const KEY_SMS_KAVENEGAR = 'sms-kavenegar';
    const KEY_SMS_KAVENEGAR_API_KEY = 'sms-kavenegar-api-key';
    const KEY_SMS_KAVENEGAR_SENDER = 'sms-kavenegar-sender';
    const KEY_SMS_SOROSH = 'sms-sorosh';
    const KEY_SMS_SOROSH_USERNAME = 'sms-sorosh-username';
    const KEY_SMS_SOROSH_PASSWORD = 'sms-sorosh-password';
    const KEY_SMS_SOROSH_API_KEY = 'sms-sorosh-api-key';
    const KEY_SMS_SOROSH_LINE_NUMBER = 'sms-sorosh-line-number';


    //################################ payment setting ################################
    const KEY_BANK_NAME = 'bank-name';

    const KEY_BANK_SADAD = 'bank-sadad';
    const KEY_SADAD_MERCHANT_ID = 'sadad-merchant-id';
    const KEY_SADAD_TERMINAL_ID = 'sadad-terminal-id';
    const KEY_SADAD_TERMINAL_KEY = 'sadad-terminal-key';
    const KEY_SADAD_PAYMENT_IDENTITY = 'sadad-payment-identity';

    const KEY_BANK_SAMAN = 'bank-saman';
    const KEY_SAMAN_TERMINAL_ID= 'saman-terminal-id';
    const KEY_SAMAN_MID= 'saman-mid';
//  const KEY_SAMAN_USERNAME= 'saman-username';
//  const KEY_SAMAN_PASSWORD= 'saman-password';
    const KEY_SAMAN_PURCHASE_ID= 'saman-purchase-id';
    const KEY_SAMAN_SHBA= 'saman-shba';

    const KEY_BANK_IRANKISH = 'bank-irankish';
    const KEY_IRANKISH_MERCHANT_ID= 'irankish-merchant-id';
    const KEY_IRANKISH_ACCEPTOR_ID= 'irankish-acceptor-id';
    const KEY_IRANKISH_PASSWORD= 'irankish-password';
    const KEY_IRANKISH_PUBLIC_KEY= 'irankish-public-key';

    const KEY_BANK_PARSIAN = 'bank-parsian';
    const KEY_PARSIAN_TERMINAL_ID= 'parsian-terminal-id';
    const KEY_PARSIAN_PIN= 'parsian-pin';


}
