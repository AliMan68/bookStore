<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Config;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentRequest;
use App\Sadad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use MyCrypt;

class PaymentController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only(['payment', 'sadadPayment','samanPayment','irankishPayment','parsianPayment']);
    }

    public function payment(Request $request){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'receiver_name'=>['required','string'],
            'receiver_number'=>['required'],
        ]);
        if ($validated_data->fails()) {
            return back()->with('fail','درج نام و شماره دریافت کننده سفارش اجباری است ');
        }

        $cardItems = Cart::all();
        $totalPrice = Cart::totalPrice();
        //validate discount code and  calculate total price
        $discountCodeId = null;
        if (!is_null($request->discount_code_value)){
            //extract code from DB
            $discountCodeId = DiscountCode::where('code',$request->discount_code_value)->first()->id;
            $discountCodePercent = DiscountCode::where('code',$request->discount_code_value)->first()->percent;
            $totalPrice = $totalPrice - ($totalPrice * $discountCodePercent/100);
        }

        $order = $request->user()->orders()->create([
            'price'=>$totalPrice,
            'status'=>'unpaid',
            'receiver_name'=>$request->receiver_name,
            'receiver_number'=>$request->receiver_number,
            'receiver_state'=>$request->receiver_state,
            'receiver_city'=>$request->receiver_city,
            'receiver_postal_code'=>$request->receiver_postal_code,
            'receiver_address'=>$request->receiver_address,
            'delivery_type'=>$request->delivery_type,
            'discount_code_id'=>$discountCodeId,
        ]);

        $products = $cardItems->mapWithKeys(function ($item){
            return [$item['book']->id => ['quantity'=>$item['quantity'],'price'=>$item['price']]];
        });

        //add orders item to order_book table
        $order->books()->attach($products);
        //next is payment
        $user = auth()->user();
        $bank = Config::getValue(Config::KEY_BANK_NAME);

        switch ($bank){
            case Config::KEY_BANK_SADAD :
                return $this->sadadPayment($user, $order);
                break;
            case Config::KEY_BANK_SAMAN :
                return $this->samanPayment($user, $order);
                break;
            case Config::KEY_BANK_IRANKISH :
                return $this->irankishPayment($user, $order);
                break;
            case Config::KEY_BANK_PARSIAN :
                return $this->parsianPayment($user, $order);
                break;
            default:
                return back()->with('fail', 'اطلاعات درگاه پرداخت دانشگاه ناقص می باشد');
        }



        return redirect($payping->getPayUrl());
    }

    public function sadadPayment($user, $order){
        $cost = $order->price;
        $p_request = PaymentRequest::create([
            'user_id' => $user->id,
            'payment_request_able_id' => $order->id,
            'payment_request_able_type' => Order::class,
            'bank_name' => Config::KEY_BANK_SADAD,
            'amount' => $cost,
            'token' => null,
            'data' => null,
            'is_verified' => 0,
        ]);

        $merchant_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_MERCHANT_ID)->value);
        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_ID)->value);
        $terminal_key = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_KEY)->value);
        $payment_identity = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_PAYMENT_IDENTITY)->value);

        $sadad = new Sadad(
            $merchant_id,
            $terminal_id,
            $terminal_key,
            $payment_identity
        );

        $response = $sadad->request($p_request->amount, $p_request->id, route('payment.verify.sadad'));
        if($response->ResCode != 0){
            $error = $response->Description;
            return view('site.failed-payment', compact('error'));

        }else{
            return redirect($sadad->getRedirectUrl() . $response->Token);
        }

    }



    public function sadadPaymentVerify(Request $request){
        Session::save();
        $p_request_id = $request->OrderId;
        $token = $request->token;
        $pay_res_code = $request->ResCode;
        $p_request = PaymentRequest::find($p_request_id);
        if ($p_request->is_verified == 1){
            return redirect(route('home'));
        }
        auth()->loginUsingId($p_request->user_id);

        if ($pay_res_code != 0){
            $error = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
            return view('site.failed-payment', compact('error'));
        }
        $merchant_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_MERCHANT_ID)->value);
        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_ID)->value);
        $terminal_key = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_KEY)->value);
        $payment_identity = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_PAYMENT_IDENTITY)->value);
        $sadad = new Sadad(
            $merchant_id,
            $terminal_id,
            $terminal_key,
            $payment_identity
        );

        $verify_response = $sadad->verify($token);
        $res_code = $verify_response->ResCode;

        //success
        if($pay_res_code == 0 && $res_code == 0){
            $amount = $verify_response->Amount;
            $description = $verify_response->Description;
            $retrival_ref_no = $verify_response->RetrivalRefNo;
            $system_trace_no = $verify_response->SystemTraceNo;
            $order_id = $verify_response->OrderId;

            $data = [
                'res_code' => $res_code,
                'amount' => $amount,
                'description' => $description,
                'retrival_ref_no' => $retrival_ref_no,
                'system_trace_no' => $system_trace_no,
            ];
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SADAD,
                'amount' => $p_request->amount,
                'receipt' => $system_trace_no,
                'data' => $data,
                'is_success' => 1,
            ]);

            $order = Order::find($p_request->payment_request_able_id);
            $order->status = 'completed';
            $order->save();
            foreach ($payment->order->books()->get() as $book){
                $currentItemCount = $book->count;
                $orderItemCount = Cart::get($book)['quantity'];
                $book->update([
                    'count'=> $currentItemCount - $orderItemCount
                ]);
                $book->save();
            }
            //clean cart after payment completed
            Cart::flush();

            $p_request->is_verified = 1;
            $p_request->save();

            return view('site.successful-payment', compact(['description', 'retrival_ref_no', 'system_trace_no', 'amount']));

        }else{
            //failed
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SADAD,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();
            $error = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
            return view('site.failed-payment', compact('error'));
        }
    }


    public function samanPayment($user, $order){
        $cost = $order->price;
        $p_request = PaymentRequest::create([
            'user_id' => $user->id,
            'payment_request_able_id' => $order->id,
            'payment_request_able_type' => Order::class,
            'bank_name' => Config::KEY_BANK_SAMAN,
            'amount' => $cost,
            'token' => null,
            'data' => null,
            'is_verified' => 0,
        ]);

        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_TERMINAL_ID)->value);
        $mid = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_MID)->value);
        $purchase_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_PURCHASE_ID)->value);
        $shba = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_SHBA)->value);
        $saman = new Saman(
            $terminal_id,
            $mid,
            $purchase_id,
            $shba
        );
        $response = $saman->requestToken($cost, $p_request->id, route('payment.verify.saman'), $user->mobile);
        if ($response->status != 1){
            $description = $response->errorDesc;
            return view('site.paymentFailed', compact('description'));
        }else{
            return $saman->redirecToPaymentPage($response->token);
        }
    }

    public function samanPaymentVerify(Request $request){
        $MID = $_POST['MID'];
        $state = $_POST['State'];
        $status = $_POST['Status'];
        $RRN = $_POST['Rrn'];
        $ref_num = $_POST['RefNum'];
        $order_id = $_POST['ResNum'];
        $terminal_id = $_POST['TerminalId'];
        $trace_no = $_POST['TraceNo'];
        $amount = $_POST['Amount'];
        $wage = $_POST['Wage'];
        $secure_pan = $_POST['SecurePan'];

        $retrival_ref_no = $RRN;
        $system_trace_no = $trace_no;

        $p_request = PaymentRequest::find($order_id);
        if ($p_request->is_verified == 1){
            return redirect(route('home'));
        }
        auth()->loginUsingId($p_request->user_id);


        if ($status != 2){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SAMAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();
            $message = Saman::$status_messages[$status];
            $description = " تراکنش ناموفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.$message";
            return view('site.paymentFailed', compact('description'));
        }


        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_TERMINAL_ID)->value);
        $mid = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_MID)->value);
        $purchase_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_PURCHASE_ID)->value);
        $shba = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_SHBA)->value);
        $saman = new Saman(
            $terminal_id,
            $mid,
            $purchase_id,
            $shba
        );
        $verify_response = $saman->verify($ref_num);


        //fail
        if ($verify_response->Success == null){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SAMAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();
            $description = " تراکنش ناموفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.";
            return view('site.paymentFailed', compact('description'));
        }

        //fail
        if ($verify_response->Success != true ){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SAMAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();
//      $message = Saman::$verify_messages[$amount];
            $message = $verify_response->ResultDescription;
            $description = " تراکنش ناموفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.$message";
            return view('site.paymentFailed', compact('description'));
        }

        //fail
        if ($verify_response->TransactionDetail->OrginalAmount  != $p_request->amount){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_SAMAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();
//      $message = $verify_response->ResultDescription;
            $description = " مبلغ پرداخت شده با مبلغ سفارش برابر نیست.لطفا با مدیریت تماس بگیرید";
            return view('site.paymentFailed', compact('description'));
        }




        //success
        $data = [
            'mid' => $MID,
            'state' => $state,
            'status' => $status,
            'rrn' => $RRN,
            'ref_num' => $ref_num,
            'res_num' => $order_id,
            'terminal_id' => $terminal_id,
            'trace_no' => $trace_no,
            'amount' => $amount,
            'wage' => $wage,
            'secure_pan' => $secure_pan,
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $payment = Payment::create([
            'user_id' => $p_request->user_id,
            'paymentable_id' => $p_request->payment_request_able_id,
            'paymentable_type' => $p_request->payment_request_able_type,
            'bank_name' => Config::KEY_BANK_SAMAN,
            'amount' => $p_request->amount,
            'receipt' => $system_trace_no,
            'data' => $data,
            'is_success' => 1,
        ]);

        $order = Order::find($p_request->payment_request_able_id);
        $order->status = 'completed';
        $order->save();
        foreach ($payment->order->books()->get() as $book){
            $currentItemCount = $book->count;
            $orderItemCount = Cart::get($book)['quantity'];
            $book->update([
                'count'=> $currentItemCount - $orderItemCount
            ]);
            $book->save();
        }
        //clean cart after payment completed
        Cart::flush();

        $p_request->is_verified = 1;
        $p_request->save();

        $description = 'پرداخت با موفقیت انجام شد';
        return view('site.paymentSuccess', compact(['description', 'retrival_ref_no', 'system_trace_no', 'amount']));
    }


    public function irankishPayment($user, $order){
        $cost = $order->price;
        $p_request = PaymentRequest::create([
            'user_id' => $user->id,
            'payment_request_able_id' => $order->id,
            'payment_request_able_type' => Order::class,
            'bank_name' => Config::KEY_BANK_IRANKISH,
            'amount' => $cost,
            'token' => null,
            'data' => null,
            'is_verified' => 0,
        ]);

        $merchant_id = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_MERCHANT_ID));
        $acceptor_id = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_ACCEPTOR_ID));
        $password = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_PASSWORD));
        $public_key = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_PUBLIC_KEY));
        $irankish = new IranKish($merchant_id, $acceptor_id, $password, $public_key);

        $response = $irankish->requestToken($p_request->amount, $p_request->id, route('payment.verify.irankish'));
        if ($response == null){
            $description = 'مشکلی در پرداخت به وجود آمده است لطفا بعدا امتحان کنید';
            return view('site.paymentFailed', compact('description'));
        }

        if ($response['responseCode'] != "00" || $response['responseCode'] != "0") {
            $description = IranKish::$status_messages[$response['responseCode']];
            return view('site.paymentFailed', compact('description'));
        }
        $token = $response['result']['token'];
        $p_request->token = $token;
        $p_request->save();
        $irankish->redirecToPaymentPage($token);
    }

    public function irankishPaymentVerify(Request $request){
        Session::save();
        if ($_POST['responseCode'] != '00' || $_POST['responseCode'] != '0'){
            $description = IranKish::$status_messages[$_POST['responseCode']] . '##';
            $description .= '.تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
            return view('site.paymentFailed', compact('description'));
        }


        $p_request_id = $_POST['requestId'];
        $p_request = PaymentRequest::find($p_request_id);
        if ($p_request->is_verified == 1){
            return redirect(route('home'));
        }
        auth()->loginUsingId($p_request->user_id);

        if ((int)$_POST['amount'] != (int)$p_request->amount ){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_IRANKISH,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->data = json_encode($_POST, JSON_UNESCAPED_UNICODE);
            $p_request->save();

            $description = 'مبلغ پرداخت شده اشتباه می باشد.در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            return view('site.paymentFailed', compact('description'));
        }



        $retrievalReferenceNumber = $_POST['retrievalReferenceNumber'];
        $systemTraceAuditNumber = $_POST['systemTraceAuditNumber'];

        $merchant_id = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_MERCHANT_ID));
        $acceptor_id = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_ACCEPTOR_ID));
        $password = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_PASSWORD));
        $public_key = MyCrypt::decrypt(Config::getValue(Config::KEY_IRANKISH_PUBLIC_KEY));
        $irankish = new IranKish($merchant_id, $acceptor_id, $password, $public_key);
        $response = $irankish->verify($retrievalReferenceNumber, $systemTraceAuditNumber, $p_request->token, $p_request->id);

        if ($response["responseCode"] != 0 || $response["responseCode"] != "00") {
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_IRANKISH,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);

            $p_request->is_verified = 1;
            $p_request->data = json_encode($response, JSON_UNESCAPED_UNICODE);
            $p_request->save();
            $description = IranKish::$status_messages[$_POST['responseCode']] . '##';
            $description .= '.تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
            return view('site.paymentFailed', compact('description'));
        }

        $response_code = $response['responseCode'];
        $description = $response['description'];
        $status = $response['status'];
        $result = $response['result'];
        if ((int)$result['amount'] != (int)$p_request->amount){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_IRANKISH,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->data = json_encode($response, JSON_UNESCAPED_UNICODE);
            $p_request->save();
            $description = 'مبلغ پرداخت شده اشتباه می باشد.در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            return view('site.paymentFailed', compact('description'));
        }



        //success
        $result['responseCode'] = $response_code;
        $result['description'] = $description;
        $result['status'] = $status;
        $system_trace_no = $result['systemTraceAuditNumber'];
        $retrival_ref_no = $result['retrievalReferenceNumber'];
        $amount = $p_request->amount;
        //check re register
        $course_user = CourseUser::where('course_id', '=', $p_request->payment_request_able_id)->where('user_id', '=', $p_request->user_id)->first();
        $description = 'پرداخت با موفقیت انجام شد';
        $data = json_encode($result, JSON_UNESCAPED_UNICODE);
        $payment = Payment::create([
            'user_id' => $p_request->user_id,
            'paymentable_id' => $p_request->payment_request_able_id,
            'paymentable_type' => $p_request->payment_request_able_type,
            'bank_name' => Config::KEY_BANK_IRANKISH,
            'amount' => $p_request->amount,
            'receipt' => $retrival_ref_no,
            'data' => $data,
            'is_success' => 1,
        ]);

        $order = Order::find($p_request->payment_request_able_id);
        $order->status = 'completed';
        $order->save();
        foreach ($payment->order->books()->get() as $book){
            $currentItemCount = $book->count;
            $orderItemCount = Cart::get($book)['quantity'];
            $book->update([
                'count'=> $currentItemCount - $orderItemCount
            ]);
            $book->save();
        }
        //clean cart after payment completed
        Cart::flush();
        $p_request->is_verified = 1;
        $p_request->save();

        $description = 'پرداخت با موفقیت انجام شد';
        return view('site.paymentSuccess', compact('description', 'retrival_ref_no', 'system_trace_no', 'amount'));
    }


    public function parsianPayment($user, $order){
        $cost = $order->price;
        $p_request = PaymentRequest::create([
            'user_id' => $user->id,
            'payment_request_able_id' => $order->id,
            'payment_request_able_type' => Order::class,
            'bank_name' => Config::KEY_BANK_PARSIAN,
            'amount' => $cost,
            'token' => null,
            'data' => null,
            'is_verified' => 0,
        ]);

        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_TERMINAL_ID)->value);
        $pin = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_PIN)->value);

        $parsian = new ParsianBank(
            $terminal_id,
            $pin
        );

        $response = $parsian->requestToken($p_request->amount, $p_request->id, route('payment.verify.parsian'));
        if ($response == null) {
            $description = 'ارتباط با بانک برقرار نشد';
            return view('site.paymentFailed', compact('description'));
        }
        if($response->Status != 0){
            $description = $response->Message;
            return view('site.paymentFailed', compact('description'));
        }else{
            $p_request->token = $response->Token;
            $p_request->save();
            return redirect($parsian->getRedirectUrl($response->Token));
        }

    }

    public function parsianPaymentVerify(Request $request){
        Session::save();
        $p_request_id = $request->OrderId;
        $token = $request->Token;
        $status = $request->status;
        $terminal_no = $request->TerminalNo;
        $amount = toFloatNumber($request->Amount);
        $rrn = $request->RRN;
        $system_trace_no = $request->STraceNo;
        $p_request = PaymentRequest::find($p_request_id);
        if ($p_request->is_verified == 1){
            return redirect(route('home'));
        }
        auth()->loginUsingId($p_request->user_id);

        if ($status != 0 || $rrn <= 0){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_PARSIAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();

            $description = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            $description .= " کد خطا : $status";
            return view('site.paymentFailed', compact('description'));
        }

        if ($amount < $p_request->amount){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_PARSIAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();

            $description = 'مبلغ پرداخت شده کمتر می باشد';
            return view('site.paymentFailed', compact('description'));
        }



        $terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_TERMINAL_ID)->value);
        $pin = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_PIN)->value);
        $parsian = new ParsianBank(
            $terminal_id,
            $pin
        );

        $verify_response = $parsian->verify($token);

        //fail
        if (is_null($verify_response)){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_PARSIAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();

            $description = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            return view('site.paymentFailed', compact('description'));
        }
        $res_code = $verify_response->Status;

        //fail
        if ($res_code != '0'){
            $payment = Payment::create([
                'user_id' => $p_request->user_id,
                'paymentable_id' => $p_request->payment_request_able_id,
                'paymentable_type' => $p_request->payment_request_able_type,
                'bank_name' => Config::KEY_BANK_PARSIAN,
                'amount' => $p_request->amount,
                'receipt' => null,
                'data' => null,
                'is_success' => 0,
            ]);
            $p_request->is_verified = 1;
            $p_request->save();

            $description = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            $description .= " کد خطا : $status";
            $description .= "-----" . $verify_response->Message;
            return view('site.paymentFailed', compact('description'));
        }




        //success
        $description = 'پرداخت با موفقیت انجام شد';
        $retrival_ref_no = $system_trace_no;
        $system_trace_no = $system_trace_no;

        //check re register and re verify

        $course_user = CourseUser::create([
            'course_id' => $p_request->payment_request_able_id,
            'user_id' => $p_request->user_id,
        ]);

        $data = [
            'res_code' => $res_code,
            'amount' => $amount,
            'description' => $description,
            'retrival_ref_no' => $retrival_ref_no,
            'system_trace_no' => $system_trace_no,
            'card_number' => $verify_response->CardNumberMasked,
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $payment = Payment::create([
            'user_id' => $p_request->user_id,
            'paymentable_id' => $p_request->payment_request_able_id,
            'paymentable_type' => $p_request->payment_request_able_type,
            'bank_name' => Config::KEY_BANK_PARSIAN,
            'amount' => $p_request->amount,
            'receipt' => $system_trace_no,
            'data' => $data,
            'is_success' => 1,
        ]);
        $order = Order::find($p_request->payment_request_able_id);
        $order->status = 'completed';
        $order->save();
        foreach ($payment->order->books()->get() as $book){
            $currentItemCount = $book->count;
            $orderItemCount = Cart::get($book)['quantity'];
            $book->update([
                'count'=> $currentItemCount - $orderItemCount
            ]);
            $book->save();
        }
        //clean cart after payment completed
        Cart::flush();
        $p_request->is_verified = 1;
        $p_request->save();

        return view('site.paymentSuccess', compact(['description', 'retrival_ref_no', 'system_trace_no', 'amount']));

    }


    public function PaypingCallback(ًRequest $request){

        $payment = Payment::where('resnumber','=',$request->clientrefid)->firstOrFail();
        $token = config('services.payping.token');

        $payping = new \PayPing\Payment($token);
        try {
            //amount = $payment->order->price
            if($verify = $payping->verify($request->refid, 1000)){
                echo "success";
                $payment->update([
                    'status' => 1
                ]);
                $payment->order->update([
                    'status'=>'completed'
                ]);

                //update inventory and redirect to success page
                foreach ($payment->order->books()->get() as $book){

                    $currentItemCount = $book->count;
                    $orderItemCount = Cart::get($book)['quantity'];
                    $book->update([
                        'count'=> $currentItemCount - $orderItemCount
                    ]);
                    $book->save();
                }

                //clean cart after payment completed
                Cart::flush();
                return view('site.successful-payment',compact('verify'));

            }else{
                $error = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
                return view('site.failed-payment',compact('error'));
            }
        } catch (Exception $e) {
            return json_decode($e->getMessage());
            echo $e->getMessage();
        }
    }
}
