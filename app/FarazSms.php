<?php


namespace App;


use App\Models\Setting;
use SoapClient;
use SoapFault;

class FarazSms {

  private $api = 'http://ippanel.com/class/sms/wsdlservice/server.php?wsdl';
  private $username;
  private $password;
  private $from_number;

  public function __construct($username = null, $password = null, $from_number = null) {
    $username1 = \MyCrypt::decrypt(Setting::get(Setting::KEY_SMS_FARAZ_USERNAME)->value);
    $password1 = \MyCrypt::decrypt(Setting::get(Setting::KEY_SMS_FARAZ_PASSWORD)->value);
    $from_number1 = \MyCrypt::decrypt(Setting::get(Setting::KEY_SMS_FARAZ_FROM_NUMBER)->value);
    (!is_null($username)) ? $this->username = $username : $this->username = $username1;
    (!is_null($password)) ? $this->password = $password : $this->password = $password1;
    (!is_null($from_number)) ? $this->from_number = $from_number : $this->from_number = $from_number1;
  }


  public function sendSms($message = '', $numbers= []){
    try {
      $client = new SoapClient($this->api);
      $op  = "send";
      $time = '';
      return $client->SendSMS($this->from_number, $numbers, $message, $this->username, $this->password, $time, $op);
    } catch (SoapFault $ex) {
      return 'er:'.$ex->faultstring;
    }
  }

  public function sendPoint2Point($messages = [], $numbers = []){
    try {
      $client = new SoapClient($this->api, array('trace' => 1));
      $op  = "pointtopoint";
      $time = '';
      return $client->SendSMS($this->from_number, $numbers, $messages, $this->username, $this->password, $time, $op);
    } catch (SoapFault $ex) {
      return $ex->faultstring;
    }

  }

  public function sendPatternSms($pattern_code = null, $numbers = [], $code = ''){
    $pattern_default =  \MyCrypt::decrypt(Setting::get(Setting::KEY_SMS_FARAZ_PATTERN_CODE)->value);
    (!is_null($pattern_code)) ? $pattern = $pattern_code : $pattern = $pattern_default;
    try {
      $client = new SoapClient($this->api);
//      $input_data = array( "tracking-code" => "1054 4-41","name" => $name);
      $input_data = array( "verification-code" => $code);
      return $client->sendPatternSms($this->from_number, $numbers, $this->username, $this->password, $pattern, $input_data);
    } catch (SoapFault $ex) {
      return $ex->faultstring;
    }
  }
}