<?php


namespace App;


use SoapClient;

class SoroshSms {

  private $api = 'http://ippanel.com/class/sms/wsdlservice/server.php?wsdl';
  private $api_key;
  private $username;
  private $password;
  private $line_number;

  public function __construct($api_key, $username, $password, $line_number) {
    $this->api_key = $api_key;
    $this->username = $username;
    $this->password = $password;
    $this->line_number = $line_number;
  }


  public function send($message = '', $numbers= []){
    ini_set("soap.wsdl_cache_enabled", "0");
    try {
      $client = new SoapClient($this->api);
      $toNum = $numbers;
      $op  = "send";
      //If you want to send in the future  ==> $time = '2016-07-30' //$time = '2016-07-30 12:50:50'
      $time = '';
      return $client->SendSMS($this->line_number,$toNum,$message,$this->username,$this->password,$time,$op);
    } catch (SoapFault $ex) {
      return $ex->faultstring;
    }
  }

  public function sendPoint2Point($messages = [], $numbers = []){
    ini_set("soap.wsdl_cache_enabled", "0");
    try {
      $client = new SoapClient($this->api, array('trace' => 1));
      $toNum = $numbers;
      $messageContent = $messages;
      $op  = "pointtopoint";
      //If you want to send in the future  ==> $time = '2016-07-30'
      $time = '';
      return $client->SendSMS($this->line_number, $toNum, $messageContent, $this->username, $this->password, $time, $op);
    } catch (SoapFault $ex) {
      return $ex->faultstring;
    }
  }
}