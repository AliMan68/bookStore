@component('site.layout.content',['title'=>'ورود|ثبت نام'])
    @slot('headerTitle')
        ورود|ثبت نام
    @endslot
    <div class="container" id="auth-container" style="margin-top:2rem;height: auto;min-height: 260px">
        <div id="phoneNumber">
            <div class="d-flex flex-column w-100 h-100">
                <h style="text-align: center;font-size: 2rem;font-weight: 600;padding-bottom: 20px;color: black" id="login-title">
                    ساخت حساب کاربری
                </h>
                <p style="text-align: center;font-size: 13px;font-weight: 500;padding-bottom: 10px;color: black" class="d-none d-md-block">
                    در سامانه انتشارت دانشگاه صنعتی شریف
                </p>
                <form class="form" method="post"  action="{{ route('auth.register') }}">
                    @csrf
                    <input type="hidden" name="mobile" value="<?php try{echo $_GET['mobile'];}catch (Exception $e){} ?>">
                    <input type="hidden" name="mobile_token" value="<?php try{echo $_GET['mobile_token'];}catch (Exception $e){} ?>">
                    <div style="direction: rtl" class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="checkout-name">*نام کامل :</label>
                                <input type="text" id="checkout-name" class="form-control required" name="name" value="{{ old('name') }}" placeholder="نام کامل" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="phone">*شماره موبایل :</label>
                                <input type="text" disabled id="phone" class="form-control required" name="" value="{{ $_GET['mobile'] }}"  placeholder="شماره موبایل" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="email">ایمیل :</label>
                                <input type="email" id="email" class="form-control required" name="email" value="{{ old('email') }}" placeholder="ایمیل خود را وارد نمایید" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="password">*رمز عبور : </label>
                                <input type="password" id="password" class="form-control " name="password"  value=""  placeholder="رمز عبور" >
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="passwordRepeat">*تکرار رمز عبور :</label>
                                <input type="password" id="passwordRepeat" class="form-control required" name="password_confirmation"  value="" placeholder="تکرار رمز عبور" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <div class="d-flex flex-row align-items-center justify-content-between" id="captchaContainer">
{{--                                @captcha--}}
{{--                                    <button type="button" class="btn btn-info btn-sm" onclick="$('#captchaContainer>img').attr('src','https://press.persiandade.ir/captcha/image?_=1267098935&amp;_='+Math.random());var captcha=document.getElementById('captcha');if(captcha){captcha.focus()}"> <i class="feather icon-refresh-cw"></i> </button>--}}
                                </div>
                                <img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/default?'+Math.random()"  alt="captcha" id="captchaCode" >
                                {{--                                        <button type="button" class="btn btn-info btn-sm" onclick="$('#captchaContainer>img').attr('src','https://press.persiandade.ir/captcha/image?_=1267098935&amp;_='+Math.random());var captcha=document.getElementById('captcha');if(captcha){captcha.focus()}"> <i class="feather icon-refresh-cw"></i> </button>--}}
                                <a type="button" href="javascript:;" class="btn btn-info btn-sm" onclick="document.getElementById('captchaCode').src='/captcha/default?'+Math.random()"> <i class="feather icon-refresh-cw"></i> </a>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control mt-2">
                            </div>

                        </div>
{{--                        <div class="col-md-4 col-sm-12">--}}
{{--                            <div class="form-group">--}}
{{--                                @captcha--}}
{{--                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-md-6 m-auto col-sm-12">
                            <div class="form-group">
                                <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                    ثبت نام  <i class="feather icon-check-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @slot('script')

    @endslot
@endcomponent
