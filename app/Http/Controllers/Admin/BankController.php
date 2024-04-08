<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use \MyCrypt;

class BankController extends Controller
{
    public function index(){
        $bank_name = Config::get(Config::KEY_BANK_NAME)->value;
        $sadad_merchant_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_MERCHANT_ID)->value);
        $sadad_terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_ID)->value);
        $sadad_terminal_key = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_TERMINAL_KEY)->value);
        $sadad_payment_identity = MyCrypt::decrypt(Config::get(Config::KEY_SADAD_PAYMENT_IDENTITY)->value);

        $saman_terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_TERMINAL_ID)->value);
        $saman_mid = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_MID)->value);
        $saman_purchase_id = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_PURCHASE_ID)->value);
        $saman_shba = MyCrypt::decrypt(Config::get(Config::KEY_SAMAN_SHBA)->value);

        $irankish_merchant_id = MyCrypt::decrypt(Config::get(Config::KEY_IRANKISH_MERCHANT_ID)->value);
        $irankish_acceptor_id = MyCrypt::decrypt(Config::get(Config::KEY_IRANKISH_ACCEPTOR_ID)->value);
        $irankish_password = MyCrypt::decrypt(Config::get(Config::KEY_IRANKISH_PASSWORD)->value);
        $irankish_public_key = MyCrypt::decrypt(Config::get(Config::KEY_IRANKISH_PUBLIC_KEY)->value);

        $parsian_terminal_id = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_TERMINAL_ID)->value);
        $parsian_pin = MyCrypt::decrypt(Config::get(Config::KEY_PARSIAN_PIN)->value);
        return view('admin.bank.setting', compact('bank_name',
            'sadad_merchant_id', 'sadad_terminal_id', 'sadad_terminal_key', 'sadad_payment_identity',
            'saman_terminal_id', 'saman_mid', 'saman_purchase_id', 'saman_shba', 'irankish_merchant_id', 'irankish_acceptor_id', 'irankish_password', 'irankish_public_key',
            'parsian_terminal_id', 'parsian_pin'));
    }

    public function update(Request $request){
        $bank_name = Config::get(Config::KEY_BANK_NAME);
        $bank_name->value = $request->bank_name;$bank_name->save();

        $sadad_merchant_id = Config::get(Config::KEY_SADAD_MERCHANT_ID);
        $sadad_merchant_id->value = MyCrypt::encrypt($request->sadad_merchant_id); $sadad_merchant_id->save();
        $sadad_terminal_id = Config::get(Config::KEY_SADAD_TERMINAL_ID);
        $sadad_terminal_id->value = MyCrypt::encrypt($request->sadad_terminal_id); $sadad_terminal_id->save();
        $sadad_terminal_key = Config::get(Config::KEY_SADAD_TERMINAL_KEY);
        $sadad_terminal_key->value = MyCrypt::encrypt($request->sadad_terminal_key); $sadad_terminal_key->save();
        $sadad_payment_identity = Config::get(Config::KEY_SADAD_PAYMENT_IDENTITY);
        $sadad_payment_identity->value = MyCrypt::encrypt($request->sadad_payment_identity); $sadad_payment_identity->save();

        $saman_terminal_id = Config::get(Config::KEY_SAMAN_TERMINAL_ID);
        $saman_terminal_id->value = MyCrypt::encrypt($request->saman_terminal_id); $saman_terminal_id->save();
        $saman_mid = Config::get(Config::KEY_SAMAN_MID);
        $saman_mid->value = MyCrypt::encrypt($request->saman_mid); $saman_mid->save();
        $saman_purchase_id = Config::get(Config::KEY_SAMAN_PURCHASE_ID);
        $saman_purchase_id->value = MyCrypt::encrypt($request->saman_purchase_id); $saman_purchase_id->save();
        $saman_shba = Config::get(Config::KEY_SAMAN_SHBA);
        $saman_shba->value = MyCrypt::encrypt($request->saman_shba); $saman_shba->save();

        $irankish_merchant_id = Config::get(Config::KEY_IRANKISH_MERCHANT_ID);
        $irankish_merchant_id->value = MyCrypt::encrypt($request->irankish_merchant_id); $irankish_merchant_id->save();
        $irankish_acceptor_id = Config::get(Config::KEY_IRANKISH_ACCEPTOR_ID);
        $irankish_acceptor_id->value = MyCrypt::encrypt($request->irankish_acceptor_id); $irankish_acceptor_id->save();
        $irankish_password = Config::get(Config::KEY_IRANKISH_PASSWORD);
        $irankish_password->value = MyCrypt::encrypt($request->irankish_password); $irankish_password->save();
        $irankish_key = Config::get(Config::KEY_IRANKISH_PUBLIC_KEY);
        $irankish_key->value = MyCrypt::encrypt($request->irankish_public_key); $irankish_key->save();

        $setting = Config::get(Config::KEY_PARSIAN_TERMINAL_ID);
        $setting->value = MyCrypt::encrypt($request->parsian_terminal_id); $setting->save();
        $setting = Config::get(Config::KEY_PARSIAN_PIN);
        $setting->value = MyCrypt::encrypt($request->parsian_pin); $setting->save();

        return back()->with('success', 'اطلاعات با موفقیت ثبت شد.');
    }
}
