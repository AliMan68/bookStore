<?php


namespace App;


use SoapClient;

class IranKish {

  private $merchant_id;
  private $password;
  private $public_key;
  private $acceptor_id;

  private $start_pay_url = 'https://ikc.shaparak.ir/api/v3/tokenization/make';
  private $redirect_url = 'https://ikc.shaparak.ir/iuiv3/IPG/Index/';
  private $verify_pay_url ='https://ikc.shaparak.ir/api/v3/confirmation/purchase';


  public static $status_messages = array(
    '5' => '‫از‬ ‫انجام‬ ‫تراکنش‬ ‫صرف‬ ‫نظر‬ ‫شد‬',
    '3' => '‫پذیرنده‬ ‫فروشگاهی‬ ‫نا‬ ‫معتبر‬ ‫است‬',
    '64' => '‫مبلغ‬ ‫تراکنش‬ ‫نادرست‬ ‫است‪،‬جمع‬ ‫مبالغ‬ ‫تقسیم‬ ‫وجوه‬ ‫برابر‬ ‫مبلغ‬ ‫کل‬ ‫تراکنش‬ ‫نمی‬ ‫باشد‬',
    '94' => '‫تراکنش‬ ‫تکراری‬ ‫است‬',
    '25' => '‫تراکنش‬ ‫اصلی‬ ‫یافت‬ ‫نشد‬',
    '77' => '‫روز‬ ‫مالی‬ ‫تراکنش‬ ‫نا‬ ‫معتبر‬ ‫است‬',
    '63' => '‫تمهیدات‬ ‫امنیتی‬ ‫نقض‬ ‫گردیده‬ ‫است‬',
    '97' => '‫کد‬ ‫تولید‬ ‫کد‬ ‫اعتبار‬ ‫سنجی‬ ‫نا‬ ‫معتبر‬ ‫است‬',
    '30' => '‫فرمت‬ ‫پیام‬ ‫نادرست‬ ‫است‬',
    '86' => '‫شتاب‬ ‫در‬ ‫حال‬ ‫‪Off‬‬ ‫‪Sign‬‬ ‫است‬',
    '55' => '‫رمز‬ ‫کارت‬ ‫نادرست‬ ‫است‬',
    '40' => '‫عمل‬ ‫درخواستی‬ ‫پشتیبانی‬ ‫نمی‬ ‫شود‬',
    '57' => '‫انجام‬ ‫تراکنش‬ ‫مورد‬ ‫درخواست‬ ‫توسط‬ ‫پایانه‬ ‫انجام‬ ‫دهنده‬ ‫مجاز‬ ‫نمی‬ ‫باشد‬',
    '58' => '‫انجام‬ ‫تراکنش‬ ‫مورد‬ ‫درخواست‬ ‫توسط‬ ‫پایانه‬ ‫انجام‬ ‫دهنده‬ ‫مجاز‬ ‫نمی‬ ‫باشد‬',
    '96' => '‫قوانین‬ ‫سامانه‬ ‫نقض‬ ‫گردیده‬ ‫است‬ ‫‪،‬‬ ‫خطای‬ ‫داخلی‬ ‫سامانه‬',
    '2' => '‫تراکنش‬ ‫قبال‬ ‫برگشت‬ ‫شده‬ ‫است‬',
    '54' => '‫تاریخ‬ ‫انقضا‬ ‫کارت‬ ‫سررسید‬ ‫شده‬ ‫است‬',
    '62' => '‫کارت‬ ‫محدود‬ ‫شده‬ ‫است‬',
    '75' => '‫تعداد‬ ‫دفعات‬ ‫ورود‬ ‫رمز‬ ‫اشتباه‬ ‫از‬ ‫حد‬ ‫مجاز‬ ‫فراتر‬ ‫رفته‬ ‫است‬',
    '14' => '‫اطالعات‬ ‫کارت‬ ‫صحیح‬ ‫نمی‬ ‫باشد‬',
    '51' => '‫موجودی‬ ‫حساب‬ ‫کافی‬ ‫نمی‬ ‫باشد‬',
    '56' => '‫اطالعات‬ ‫کارت‬ ‫یافت‬ ‫نشد‬',
    '61' => '‫مبلغ‬ ‫تراکنش‬ ‫بیش‬ ‫از‬ ‫حد‬ ‫مجاز‬ ‫است‬',
    '65' => '‫تعداد‬ ‫دفعات‬ ‫انجام‬ ‫تراکنش‬ ‫بیش‬ ‫از‬ ‫حد‬ ‫مجاز‬ ‫است‬',
    '78' => '‫کارت‬ ‫فعال‬ ‫نیست‬',
    '79' => '‫حساب‬ ‫متصل‬ ‫به‬ ‫کارت‬ ‫بسته‬ ‫یا‬ ‫دارای‬ ‫اشکال‬ ‫است‬',
    '42' => '‫کارت‬ ‫یا‬ ‫حساب‬ ‫مقصد‬ ‫در‬ ‫وضعیت‬ ‫پذیرش‬ ‫نمی‬ ‫باشد‬',
    '901' => '‫درخواست‬ ‫نا‬ ‫معتبر‬ ‫است‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '902' => '‫پارامترهای‬ ‫اضافی‬ ‫درخواست‬ ‫نامعتبر‬ ‫می‬ ‫باشد		‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '903' => '‫شناسه‬ ‫پرداخت‬ ‫نامعتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '904' => '‫اطالعات‬ ‫مرتبط‬ ‫با‬ ‫قبض‬ ‫نا‬ ‫معتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '905' => '‫شناسه‬ ‫درخواست‬ ‫نامعتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '906' => '‫درخواست‬ ‫تاریخ‬ ‫گذشته‬ ‫است‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '907' => '‫آدرس‬ ‫بازگشت‬ ‫نتیجه‬ ‫پرداخت‬ ‫نامعتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '909' => '‫پذیرنده‬ ‫نامعتبر‬ ‫می‬ ‫باشد(‬ ‫‪Tokenization‬‬ ‫)‬',
    '910' => '‫پارامترهای‬ ‫مورد‬ ‫انتظار‬ ‫پرداخت‬ ‫تسهیمی‬ ‫تامین‬ ‫نگردیده‬ ‫است(‬ ‫‪Tokenization‬‬ ‫)‬',
    '911' => '‫پارامترهای‬ ‫مورد‬ ‫انتظار‬ ‫پرداخت‬ ‫تسهیمی‬ ‫نا‬ ‫معتبر‬ ‫یا‬ ‫دارای‬ ‫اشکال‬ ‫می‬ ‫باشد(‬ ‫‪Tokenization‬‬ ‫)‬',
    '912' => '‫تراکنش‬ ‫درخواستی‬ ‫برای‬ ‫پذیرنده‬ ‫فعال‬ ‫نیست‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '913' => '‫تراکنش‬ ‫تسهیم‬ ‫برای‬ ‫پذیرنده‬ ‫فعال‬ ‫نیست‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '914' => '‫آدرس‬ ‫آی‬ ‫پی‬ ‫دریافتی‬ ‫درخواست‬ ‫نا‬ ‫معتبر‬ ‫می‬ ‫باشد‬',
    '915' => '‫شماره‬ ‫پایانه‬ ‫نامعتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '916' => '‫شماره‬ ‫پذیرنده‬ ‫نا‬ ‫معتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '917' => '‫نوع‬ ‫تراکنش‬ ‫اعالم‬ ‫شده‬ ‫در‬ ‫خواست‬ ‫نا‬ ‫معتبر‬ ‫می‬ ‫باشد‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '918' => '‫پذیرنده‬ ‫فعال‬ ‫نیست‬',
    '919' => '‫مبالغ‬ ‫تسهیمی‬ ‫ارائه‬ ‫شده‬ ‫با‬ ‫توجه‬ ‫به‬ ‫قوانین‬ ‫حاکم‬ ‫بر‬ ‫وضعیت‬ ‫تسهیم‬ ‫پذیرنده‬ ‫‪،‬‬ ‫نا‬ ‫معتبر‬ ‫است‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '920' => '‫شناسه‬ ‫نشانه‬ ‫نامعتبر‬ ‫می‬ ‫باشد‬',
    '921' => '‫شناسه‬ ‫نشانه‬ ‫نامعتبر‬ ‫و‬ ‫یا‬ ‫منقضی‬ ‫شده‬ ‫است‬',
    '922' => '‫نقض‬ ‫امنیت‬ ‫درخواست‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '923' => '‫ارسال‬ ‫شناسه‬ ‫پرداخت‬ ‫در‬ ‫تراکنش‬ ‫قبض‬ ‫مجاز‬ ‫نیست‬ ‫(‬ ‫‪Tokenization‬‬ ‫)‬',
    '925' => '‫مبلغ‬ ‫مبادله‬ ‫شده‬ ‫نا‬ ‫معتبر‬ ‫می‬ ‫باشد‬',
  );

  public function __construct($merchant_id = '', $acceptor_id = '', $password = '', $public_key = '') {
    $this->merchant_id = $merchant_id;
    $this->acceptor_id = $acceptor_id;
    $this->password = $password;
    $this->public_key = $public_key;
  }

  public function requestToken($amount, $order_id, $redirect_url){
    $token = $this->generateAuthenticationEnvelope($this->public_key, $this->merchant_id, $this->password, (int)$amount);
    $data["request"] = array(
      "acceptorId" => $this->acceptor_id,
      "amount" => (int) $amount,
      "billInfo" => null,
      "requestId" => (string)$order_id,
      "paymentId" => (string) $order_id,
      "requestTimestamp" => time(),
      "revertUri" => $redirect_url,
      "terminalId" => $this->merchant_id,
      "transactionType" => "Purchase",
    );
    $data['authenticationEnvelope'] = $token;
    $data_string = json_encode($data);

    try {
      $response = $this->callApi($this->start_pay_url, $data_string);
      return json_decode($response, JSON_OBJECT_AS_ARRAY);
    }catch (\Exception $e){
      return null;
    }
  }



  public function redirecToPaymentPage($token){
    $data['tokenIdentity'] = $token;

    echo '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<title>در حال اتصال ...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
	#main {
	    background-color: #F1F1F1;
	    border: 1px solid #CACACA;
	    height: 90px;
	    left: 50%;
	    margin-left: -265px;
	    position: absolute;
	    top: 200px;
	    width: 530px;
	}
	#main p {
	    color: #757575;
	    direction: rtl;
	    font-family: Arial;
	    font-size: 16px;
	    font-weight: bold;
	    line-height: 27px;
	    margin-top: 30px;
	    padding-right: 60px;
	    text-align: right;
	}
    </style>
        <script type="text/javascript">
            function closethisasap() {
                document.forms["redirectpost"].submit();
            }
        </script>
    </head>
    <body onload="closethisasap();">';
    echo '<form name="redirectpost" method="post" action="'.$this->redirect_url.'">';

    if ( !is_null($data) ) {
      foreach ($data as $k => $v) {
        echo '<input type="hidden" name="' . $k . '" value="' . $v . '"> ';
      }
    }

    echo' <button type="submit"> پرداخت</button> </form><div id="main"><p>درحال اتصال به درگاه بانک ...</p></div>
    </body>
    </html>';

    exit();
  }


  public function verify($retrievalReferenceNumber, $systemTraceAuditNumber, $token, $request_id){
//    $params['passPhrase'] = $this->password;
    $params['terminalId'] = $this->merchant_id;
    $params['retrievalReferenceNumber'] = $retrievalReferenceNumber;
    $params['systemTraceAuditNumber'] = $systemTraceAuditNumber;
    $params['tokenIdentity'] = $token;
//    $params['requestId'] = (string)$request_id;
//    $params['findOption'] = 2;
    $data_string = json_encode($params);
    try {
      $response = $this->callApi($this->verify_pay_url, $data_string);
      return json_decode($response, JSON_OBJECT_AS_ARRAY);
    }catch (\Exception $e){
      return null;
    }
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


  private function generateAuthenticationEnvelope($pub_key, $terminalID, $password, $amount)
  {
    $data = $terminalID . $password . str_pad($amount, 12, '0', STR_PAD_LEFT) . '00';
    $data = hex2bin($data);
    $AESSecretKey = openssl_random_pseudo_bytes(16);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($data, $cipher, $AESSecretKey, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash('sha256', $ciphertext_raw, true);
    $crypttext = '';

    openssl_public_encrypt($AESSecretKey . $hmac, $crypttext, $pub_key);

    return array(
      "data" => bin2hex($crypttext),
      "iv" => bin2hex($iv),
    );
  }









}