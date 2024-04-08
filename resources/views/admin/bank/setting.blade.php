
@component('admin.layouts.content',['title'=>'مدیریت درگاه بانکی'])

    @slot('title')
        مدیریت درگاه بانکی
    @endslot
    @slot('headerTitle')
        مدیریت درگاه بانکی
    @endslot
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form action="{{route('admin.bank.update')}}" id="form" method="post" class="" enctype="multipart/form-data">
                @csrf
                <div style="direction: rtl"  class="row p-1 py-3">

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> نام درگاه پرداخت :</label>
                            <select class="form-control" name="bank_name" required>
                                <option value="{{\App\Models\Config::KEY_BANK_SADAD}}"
                                        @if($bank_name == \App\Models\Config::KEY_BANK_SADAD) selected @endif>
                                    سداد(بانک ملی)
                                </option>

                                <option value="{{\App\Models\Config::KEY_BANK_SAMAN}}"
                                        @if($bank_name == \App\Models\Config::KEY_BANK_SAMAN) selected @endif>
                                    سامان کیش(بانک سامان)
                                </option>

                                <option value="{{\App\Models\Config::KEY_BANK_IRANKISH}}"
                                        @if($bank_name == \App\Models\Config::KEY_BANK_IRANKISH) selected @endif>
                                    درگاه ایران کیش
                                </option>

                                <option value="{{\App\Models\Config::KEY_BANK_PARSIAN}}"
                                        @if($bank_name == \App\Models\Config::KEY_BANK_PARSIAN) selected @endif>
                                    درگاه پارسیان
                                </option>
                            </select>
                        </div>
                    </div>




                    <div class="dropdown-divider w-100"></div>


                    <h5>اطلاعات سداد(بانک ملی)</h5>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کد درگاه(merchant_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$sadad_merchant_id}}" class="form-control "  name="sadad_merchant_id" placeholder="کد درگاه" >
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شماره ترمینال(terminal_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$sadad_terminal_id}}" class="form-control "  name="sadad_terminal_id" placeholder="شماره ترمینال" >
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کلید ترمینال(terminal_key) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$sadad_terminal_key}}" class="form-control "  name="sadad_terminal_key" placeholder="کلید ترمینال" >
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شناسه پرداخت(payment_identity) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$sadad_payment_identity}}" class="form-control "  name="sadad_payment_identity" placeholder="شناسه پرداخت" >
                        </div>
                    </div>





                    <div class="dropdown-divider w-100"></div>
                    <div class="dropdown-divider w-100"></div>

                    <h5>اطلاعات سامان کیش(بانک سامان)</h5>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شماره ترمینال(terminal_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$saman_terminal_id}}" class="form-control "  name="saman_terminal_id" placeholder="شماره ترمینال" >
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شماره MID(MID) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$saman_mid}}" class="form-control "  name="saman_mid" placeholder="شماره MID" >
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شناسه پرداخت (purchase_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$saman_purchase_id}}" class="form-control "  name="saman_purchase_id" placeholder="شناسه پرداخت" >
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> شبا (shba) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$saman_shba}}" class="form-control "  name="saman_shba" placeholder="شبا" >
                        </div>
                    </div>




                    <div class="dropdown-divider w-100"></div>
                    <div class="dropdown-divider w-100"></div>

                    <h5>اطلاعات ایران کیش</h5>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کد درگاه-پایانه( merchant_id-terminal_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$irankish_merchant_id}}" class="form-control "  name="irankish_merchant_id" placeholder="کد درگاه" >
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کد پذیرنده(acceptor_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$irankish_acceptor_id}}" class="form-control "  name="irankish_acceptor_id" placeholder="کد پذیرنده" >
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کلمه عبور(password) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$irankish_password}}" class="form-control "  name="irankish_password" placeholder="پسورد" >
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کلید عمومی(public_key) :</label>
                            <textarea style="direction: ltr" type="text" id="name"  class="form-control "  name="irankish_public_key" placeholder="کلید عمومی">{{$irankish_public_key}}</textarea>
                        </div>
                    </div>




                    <div class="dropdown-divider w-100"></div>
                    <div class="dropdown-divider w-100"></div>

                    <h5>اطلاعات پارسیان</h5>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> کد درگاه-پایانه( terminal_id) :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$parsian_terminal_id}}" class="form-control "  name="parsian_terminal_id" placeholder="کد درگاه" >
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name"> pin :</label>
                            <input style="direction: ltr" type="text" id="name" value="{{$parsian_pin}}" class="form-control "  name="parsian_pin" placeholder="pin" >
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-white  place-order">ثبت</button>
            </form>
        </div>
    </div>

@endcomponent

