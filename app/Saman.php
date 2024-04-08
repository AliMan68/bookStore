<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/28/2021
 * Time: 4:35 PM
 */

namespace App;


class Saman {
  private $terminal_id;
  private $MID;
  private $purchase_id;
  private $shba;
//  private $start_pay_url = 'https://sep.shaparak.ir/MobilePG/MobilePayment';
  private $start_pay_url = 'https://sep.shaparak.ir/OnlinePG/OnlinePG';
  private $redirect_url = 'https://sep.shaparak.ir/OnlinePG/OnlinePG';
//  private $verify_pay_url ='https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL';
  private $verify_pay_url ='https://sep.shaparak.ir/verifyTxnRandomSessionkey/ipg/VerifyTransaction';




  //structers
  /* get token response
   {status, errorCode, errorDesc, token} */



  /*after pay response
  (POST) {MID, State, Status, RPN, RefNum, ResNum, TerminalId, TraceNo, Amount, Wage, SecurePan}
  */

  //Status can be below codes
  public static $status_messages = [
    1 => 'کاربر انصراف داده است',
    2 => 'پرداخت با موفقیت انجام شد',
    3 => 'پرداخت انجام نشد',
    4 => 'کاربر در بازه زمانی تعیین شده پاسخی ارسال نکرده است',
    5 => 'پارامترهای ارسالی نامعتبر است',
    8 => 'آدرس سرور پذیرنده نامعتبر است',
    10 => 'توکن ارسال شده یافت نشد.',
    11 => 'با این شماره ترمینال فقط تراکنش های توکنی قابل پرداخت هستند',
    12 => 'شماره ترمینال ارسال شده یافت نشد',
  ];


  public static $verify_messages = [
    -1 => 'خطای در پردازش اطلاعات ارسالی. )مشکل در یکی از ورودیها و ناموفق بودن فراخوانی متد برگشت تراکنش(',
    -3 => 'ورودیها حاوی کارکترهای غیرمجاز میباشند.',
    -4 => ' کلمه عبور یا کد فروشنده اشتباه است',
    -6 => 'تراکنش قبلا برگشت داده شده است.',
    -7 => 'رسید دیجیتالی تهی است.',
    -8 => 'طول ورودیها بیشتر از حد مجاز است. ',
    -9 => 'وجود کارکترهای غیرمجاز در مبلغ برگشتی.',
    -10 => 'رسید دیجیتالی به صورت Base64 نیست )حاوی کارکترهای غیرمجاز است(.',
    -11 => 'طول ورودیها کمتر از حد مجاز است.',
    -12 => 'مبلغ برگشتی منفی است.',
    -13 => 'مبلغ برگشتی برای برگشت جزئی بیش از مبلغ برگشت نخوردهی رسید دیجیتالی است.',
    -14 => 'چنین تراکنشی تعریف نشده است.',
    -15 => 'مبلغ برگشتی به صورت اعشاری داده شده است.',
    -16 => 'خطای داخلی سیستم',
    -17 => 'برگشت زدن جزیی تراکنش مجاز نمی باشد.',
    -18 => 'IP Address فروشنده نا معتبر است',
  ];



  public function __construct($terminal_id, $MID = '', $purchase_id = '', $shba = '') {
    $this->terminal_id = $terminal_id;
    $this->MID = $MID;
    $this->purchase_id = $purchase_id;
    $this->shba = $shba;

  }


  public function requestToken($amount, $order_id, $redirect_url, $mobile = ''){
    $data = array(
      'Action' => "token",
      'Amount' => $amount,
      'TerminalId' => $this->terminal_id,
      'MID' => $this->MID,
      'ResNum' => $order_id,
      'RedirectURL' => $redirect_url,
      'CellNumber' => $mobile,
      'SettlementIBANInfo' => [['IBAN' => $this->shba, 'Amount' => $amount, 'PurchaseId' => $this->purchase_id, '']]
    );



    $str_data = json_encode($data);


    $response = $this->callApi($this->start_pay_url, $str_data);
    $response = json_decode($response);
    /*
     * response
     * status => 1 is success and -1 is failed
     * errorCode => when status is -1 check this
     * errorDesc => when status is -1 check this
     * token => when status is 1 get this
     * */
    return $response;
  }



  public function redirecToPaymentPage($token){
    $str =
      "<body onload=\"setTimeout(function() { document.frm1.submit() }, 2)\">
      <h3 style='text-align: center'>در حال انتقال به صفحه پرداخت...</h3>
      <form name=\"frm1\" onload=\"document.forms['forms'].submit()\" action=\"$this->redirect_url\" method=\"post\">
      <input type=\"hidden\" name=\"Token\" value=\"$token\" />
      <input type=\"hidden\" name=\"GetMethod\" type=\"text\" value=\"false\"> <!--true | false | empty string | null-->
      <button type=\"submit\" style=\"text-align: center\"> برو به صفحه پرداخت</button>
      </form>
    </body>";

    die($str);
  }


  public function verify($ref_num){
    $data = array(
      'RefNum' => $ref_num,
      'MID' => $this->MID,
      'TerminalNumber' => $this->terminal_id,
      'NationalCode' => "Null",
      'IgnoreNationalCode' => true,
    );

    $str_data = json_encode($data);
    $response = $this->callApi($this->verify_pay_url, $str_data);
    try {
      $response = json_decode($response);
    }catch (\Exception $e){}
    return $response;
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

}