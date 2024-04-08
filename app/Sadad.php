<?php


namespace App;


class Sadad {



  private $merchant_id;
  private $terminal_id;
  private $terminal_key;
  private $payment_identity;
  private $start_pay_url = 'https://sadad.shaparak.ir/api/v0/PaymentByIdentity/PaymentRequest';
//  private $start_pay_url = 'https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest';
  private $redirect_url = 'https://sadad.shaparak.ir/VPG/Purchase?Token=';
  private $verify_pay_url ='https://sadad.shaparak.ir/VPG/api/v0/Advice/Verify';


  public function __construct($merchant_id, $terminal_id, $terminal_key, $payment_identity) {
    $this->merchant_id = $merchant_id;
    $this->terminal_id = $terminal_id;
    $this->terminal_key = $terminal_key;
    $this->payment_identity = $payment_identity;
  }


  public function request($amount, $order_id, $call_back_url, $local_date_time = null){
    if(is_null($local_date_time)){
      $local_date_time = date("m/d/Y g:i:s a");
    }

    $sign_data = $this->encrypt_pkcs7("$this->terminal_id;$order_id;$amount", $this->terminal_key);

    $data = array(
      'MerchantId' => $this->merchant_id,
      'TerminalId' => $this->terminal_id,
      'Amount' => $amount,
      'OrderId' => $order_id,
      'LocalDateTime' => $local_date_time,
      'ReturnUrl' => $call_back_url,
      'SignData' => $sign_data,
      'PaymentIdentity' => $this->payment_identity
    );



    $str_data = json_encode($data);



    $response = $this->callApi($this->start_pay_url, $str_data);//
    $response = json_decode($response);
    return $response;
    //$response_data->ResCode ?== 0 => success   &&  $response_data->Token && $response_data->Description
  }



  public function redirect($token){
    $url = $this->redirect_url . $token;
//    header("Location:$url");
    return redirect($url);
  }


  public function verify($token){

    $verify_data = array(
      'Token'=>$token, 'SignData' => $this->encrypt_pkcs7($token, $this->terminal_key)
    );
    $str_data = json_encode($verify_data);
    $response = $this->callApi($this->verify_pay_url, $str_data);
    $response_data = json_decode($response);

    return $response_data;



  }



  private function callApi($url, $data = false){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data)));
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
  }



  public function getRedirectUrl(){
    return $this->redirect_url;
  }


  private function encrypt_pkcs7($str, $key){
    $key = base64_decode($key);
    $ciphertext = OpenSSL_encrypt($str,"DES-EDE3", $key, OPENSSL_RAW_DATA);
    return base64_encode($ciphertext);
  }


  private static function decrypt_pkcs7($encrypted, $key){
    $key = base64_decode($key);
    $encrypted = base64_decode($encrypted);
    $text = OpenSSL_decrypt($encrypted,"DES-EDE3", $key, OPENSSL_RAW_DATA);
    return $text;
  }




}