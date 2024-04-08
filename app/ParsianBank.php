<?php


namespace App;


use SoapClient;

class ParsianBank {
  private $terminal_id;
  private $pin;

  private $start_pay_url = 'https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl';
  private $redirect_url = 'https://pec.shaparak.ir/NewIPG/?Token=';
  private $verify_pay_url ='https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?wsdl';

  public function __construct($terminal_id, $pin) {
    $this->terminal_id = $terminal_id;
    $this->pin = $pin;
  }

  public function requestToken($amount, $order_id, $call_back_url){
    $params = array (
      "LoginAccount" => $this->pin,
      "Amount" => $amount,
      "OrderId" => $order_id,
      "CallBackUrl" => $call_back_url
    );
    $client = new SoapClient($this->start_pay_url);

    try {
      $result = $client->SalePaymentRequest ( array (
        "requestData" => $params
      ) );
      return $result->SalePaymentRequestResult;
    } catch ( Exception $ex ) {
      return null;
    }
  }


  public function getRedirectUrl($token = '') {
    return $this->redirect_url . $token;
  }


  public function verify($token){
    $params = array (
      "LoginAccount" => $this->pin,
      "Token" => $token
    );
    $client = new SoapClient ( $this->verify_pay_url );
    try {
      $result = $client->ConfirmPayment ( array (
        "requestData" => $params
      ) );
      return $result->ConfirmPaymentResult;
    } catch ( Exception $ex ) {
      return null;
    }
  }

}