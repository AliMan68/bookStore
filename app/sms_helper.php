<?php


use App\GhasedakSms;
use App\Helper\SmsIr\SmsIRClient;
use App\Models\Setting;
use GuzzleHttp\Client;
use Kavenegar\KavenegarApi;
use Ipe\Sdk\Facades\SmsIr;

function sendMessageRegister($user){
  try {
    $name = getFullName($user);
    $message = "کاربر محترم ثبت نام شما با موفقیت انجام شد.";

    $message .= "نام کاربری:$user->mobile رمزعبور:$user->national_code";
    $message .= " سامانه ساجد دانشگاه ";
    $univ_name = \App\Models\Config::get(\App\Models\Config::KEY_UNIVERSITY_NAME)->value;
    $message .= $univ_name;
    $message .= " ";
    $link = env('APP_URL');
    $link = str_replace('https://', '', $link);
    $link = str_replace('http://', '', $link);
    $message .= $link;

    $sms_company = Config::get(Config::KEY_SMS_COMPANY)->value;
    if ($sms_company == Config::KEY_SMS_IR){
        $smsir = new SmsIRClient(Config::get(Config::KEY_SMS_IR_API_KEY),
            Config::get(Config::KEY_SMS_IR_SECRET_KEY),
            Config::get(Config::KEY_SMS_IR_LINE_NUMBER));
        try {
            $smsir->send([$message], [$user->mobile]);
        }catch (Exception $e){}
    }elseif ($sms_company == Config::KEY_SMS_FARAZ){
      $sms = new \App\FarazSms();
      $mobile = '0' . toNumber($user->mobile);
      $sms->sendSms($message, [$mobile]);
    }elseif ($sms_company == Config::KEY_SMS_KAVENEGAR){
      $kavenegar_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_API_KEY)->value);
      $kavenegar_sender = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_SENDER)->value);
      $kave = new KavenegarApi($kavenegar_api_key);
      $kave->Send($kavenegar_sender,$user->mobile,$message);
    }elseif ($sms_company == Config::KEY_SMS_SOROSH){
      $sorosh_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_API_KEY)->value);
      $sorosh_line_number = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_LINE_NUMBER)->value);
      $sorosh_username = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_USERNAME)->value);
      $sorosh_password = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_PASSWORD)->value);
      $sorosh = new \App\SoroshSms($sorosh_api_key, $sorosh_username, $sorosh_password, $sorosh_line_number);
      $sorosh->send($message,['0' . toNumber($user->mobile)]);
    }else{
//      die('تنظیمات پنل sms برای سیستم تنظیم نشده است');
    }

  }catch (Exception $e){}
}

function sendInsertContractMessage($user, $contract){
  try {
    $name = getFullName($user);
    $message = "مجری محترم قراداد جدیدی برای شما ثبت شد";
    $message .= " سامانه ساجد ";
    $univ_name = \App\Models\Config::get(\App\Models\Config::KEY_UNIVERSITY_NAME)->value;
    $message .= $univ_name;
    $message .= " ";
    $link = env('APP_URL');
    $link = str_replace('https://', '', $link);
    $link = str_replace('http://', '', $link);
    $message .= $link;


    $sms_company = Config::get(Config::KEY_SMS_COMPANY)->value;
    if ($sms_company == Config::KEY_SMS_IR){
        $smsir = new SmsIRClient(Config::get(Config::KEY_SMS_IR_API_KEY),
            Config::get(Config::KEY_SMS_IR_SECRET_KEY),
            Config::get(Config::KEY_SMS_IR_LINE_NUMBER));
        try {
            $smsir->send([$message], [$user->mobile]);
        }catch (Exception $e){}
    }elseif ($sms_company == Config::KEY_SMS_FARAZ){
      $sms = new \App\FarazSms();
      $mobile = '0' . toNumber($user->mobile);
      $sms->sendSms($message, [$mobile]);
    }elseif ($sms_company == Config::KEY_SMS_KAVENEGAR){
      $kavenegar_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_API_KEY)->value);
      $kavenegar_sender = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_SENDER)->value);
      $kave = new KavenegarApi($kavenegar_api_key);
      $kave->Send($kavenegar_sender,$user->mobile,$message);
    }elseif ($sms_company == Config::KEY_SMS_SOROSH){
      $sorosh_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_API_KEY)->value);
      $sorosh_line_number = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_LINE_NUMBER)->value);
      $sorosh_username = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_USERNAME)->value);
      $sorosh_password = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_PASSWORD)->value);
      $sorosh = new \App\SoroshSms($sorosh_api_key, $sorosh_username, $sorosh_password, $sorosh_line_number);
      $sorosh->send($message,['0' . toNumber($user->mobile)]);
    }else{
//      die('تنظیمات پنل sms برای سیستم تنظیم نشده است');
    }


  }catch (Exception $e){}
}

function sendMessage($user, $message){
  try {
    $sms_company = Config::get(Config::KEY_SMS_COMPANY)->value;
    if ($sms_company == Config::KEY_SMS_IR){
        $smsir = new SmsIRClient(Config::get(Config::KEY_SMS_IR_API_KEY),
            Config::get(Config::KEY_SMS_IR_SECRET_KEY),
            Config::get(Config::KEY_SMS_IR_LINE_NUMBER));
        try {
            $smsir->send([$message], [$user->mobile]);
        }catch (Exception $e){}
    }elseif ($sms_company == Config::KEY_SMS_FARAZ){
      $sms = new \App\FarazSms();
      $mobile = '0' . toNumber($user->mobile);
      $sms->sendSms($message, [$mobile]);
    }elseif ($sms_company == Config::KEY_SMS_KAVENEGAR){
      $kavenegar_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_API_KEY)->value);
      $kavenegar_sender = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_SENDER)->value);
      $kave = new KavenegarApi($kavenegar_api_key);
      $kave->Send($kavenegar_sender,$user->mobile,$message);
    }elseif ($sms_company == Config::KEY_SMS_SOROSH){
      $sorosh_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_API_KEY)->value);
      $sorosh_line_number = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_LINE_NUMBER)->value);
      $sorosh_username = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_USERNAME)->value);
      $sorosh_password = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_PASSWORD)->value);
      $sorosh = new \App\SoroshSms($sorosh_api_key, $sorosh_username, $sorosh_password, $sorosh_line_number);
      $sorosh->send($message,['0' . toNumber($user->mobile)]);
    }else{
//      die('تنظیمات پنل sms برای سیستم تنظیم نشده است');
    }



//    Smsirlaravel::send([$message], [$user->mobile]);
//    $sms = new \App\FarazSms();
//    $mobile = '0' . toNumber($user->mobile);
//    $sms->sendSms($message, [$mobile]);
  }catch (Exception $e){}
}

function sendGroupMessage($messages, $mobiles){
  $i = 0;
  foreach ($mobiles as $mobile){
    $mobiles[$i] = '0' . toNumber($mobiles[$i]);
    $i++;
  }
  try {

    $sms_company = Config::get(Config::KEY_SMS_COMPANY)->value;
    if ($sms_company == Config::KEY_SMS_IR){
        $smsir = new SmsIRClient(Config::get(Config::KEY_SMS_IR_API_KEY),
            Config::get(Config::KEY_SMS_IR_SECRET_KEY),
            Config::get(Config::KEY_SMS_IR_LINE_NUMBER));
        try {
            $smsir->send($messages, $mobiles);
        }catch (Exception $e){}
    }elseif ($sms_company == Config::KEY_SMS_FARAZ){
      $sms = new \App\FarazSms();
      $sms->sendPoint2Point($messages, $mobiles);
    }elseif ($sms_company == Config::KEY_SMS_KAVENEGAR){
      $kavenegar_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_API_KEY)->value);
      $kavenegar_sender = MyCrypt::decrypt(Config::get(Config::KEY_SMS_KAVENEGAR_SENDER)->value);
      $kave = new KavenegarApi($kavenegar_api_key);
      $sender = [];
      foreach ($mobiles as $mobile){
        $sender [] = $kavenegar_sender;
      }
      $kave->SendArray($sender, $mobiles, $messages);
    }elseif ($sms_company == Config::KEY_SMS_SOROSH){
      $sorosh_api_key = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_API_KEY)->value);
      $sorosh_line_number = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_LINE_NUMBER)->value);
      $sorosh_username = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_USERNAME)->value);
      $sorosh_password = MyCrypt::decrypt(Config::get(Config::KEY_SMS_SOROSH_PASSWORD)->value);
      $sorosh = new \App\SoroshSms($sorosh_api_key, $sorosh_username, $sorosh_password, $sorosh_line_number);
      $sorosh->sendPoint2Point($messages,$mobiles);
    }else{
//      die('تنظیمات پنل sms برای سیستم تنظیم نشده است');
    }

  }catch (Exception $e){}
}


//this is from our sms ir
function sendResetPasswordCode($number, $code){
  try{
//    $template_code = MyCrypt::decrypt(Config::get(Config::KEY_SMS_IR_TEMPLATE_NUMBER)->value);
      $template_code = 234915;
//    $result = smsIrFast(['VerificationCode' => $code], toNumber($template_code), toNumber($number));
      $result = smsIrFast([["name" => "CODE", "value" => $code]], toNumber($template_code), toNumber($number));
  }catch (Exception $e){}
}

//function sendRegisterPasswordCode($number, $code){
//  try{
//    $template_code = MyCrypt::decrypt(Config::get(Config::KEY_SMS_IR_TEMPLATE_NUMBER)->value);
//    $result = smsIrFast(['VerificationCode' => $code], toNumber($template_code), toNumber($number));
//  }catch (Exception $e){}
//}


function sendRegisterPasswordCode($number, $code){
    try{
//        $template_code = MyCrypt::decrypt(Setting::get(Setting::KEY_SMS_IR_TEMPLATE_NUMBER)->value);
        $template_code = 234915;
        $result = smsIrFast([["name" => "CODE", "value" => $code]], toNumber($template_code), toNumber($number));
//        $result = smsIrFast(['VerificationCode' => $code], toNumber($template_code), toNumber($number));
    }catch (Exception $e){}
}




function smsIrFast(array $parameters, $template_id, $number){
    $response = SmsIr::verifySend($number, $template_id, $parameters);
    return $response;
}

//
//function smsIrFast(array $parameters, $template_id, $number){
//  $params = [];
//  foreach ($parameters as $key => $value) {
//    $params[] = ['Parameter' => $key, 'ParameterValue' => $value];
//  }
//  $client = new Client();
//  $body   = ['ParameterArray' => $params,'TemplateId' => $template_id,'Mobile' => $number];
//  $result = $client->post('https://ws.sms.ir/api/UltraFastSend',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>smsIrGetToken()],'connect_timeout'=>30]);
//  return json_decode($result->getBody(),true);
//}


function smsIrGetToken(){
  $client     = new Client();
  $body       = [
    'UserApiKey' => MyCrypt::decrypt('eyJpdiI6IkJHckpHOWZSdkVYNk56U1hNYTFYMFE9PSIsInZhbHVlIjoiRnNJV0VOYldLbVhyeVVRdFpxZTZaaVJGdXRPclJreVIrTXRWaVB4SlR4ND0iLCJtYWMiOiIwZjgxOWZjNDJjMDBhODQ4OTUyNWQ2Yzg3NGM1MGRlNWZkOGVlMzIwYWRiMDNlYmMzMjY3OWZkZDNiNzA5OGNmIn0='),
    'SecretKey' => MyCrypt::decrypt('eyJpdiI6IlpWUGxzSXVjTDBnYVhLcFlWeW82clE9PSIsInZhbHVlIjoiMkpqRVBjRUgwSUVIMTcyVEhJUnUwUzZBSVZzeFp3a2JmN2JaWUtYOVRLOD0iLCJtYWMiOiJlODdmNGMzMzBlNzYwNDA2NDgyZmI5NWM3ZTdlNDhjYjY4NDZlNGQwMTNkNmI5MTMzZWY1YmRhMzJhOWI1MjIyIn0='),
    'System' => 'laravel_v_1_4'
  ];
  $result = $client->post('https://ws.sms.ir/api/Token',['json'=>$body,'connect_timeout'=>30]);
  return json_decode($result->getBody(),true)['TokenKey'];
}
