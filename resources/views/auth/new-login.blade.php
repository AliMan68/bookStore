@component('site.layout.content',['title'=>'ورود|ثبت نام'])
    @slot('headerTitle')
        ورود|ثبت نام
    @endslot
    <div class="container" id="auth-container" style="margin-top:2rem!important;height: auto;min-height: 260px">
        <div id="phoneNumber">
            <div class="d-flex flex-column w-100 h-100">
                <h style="text-align: center;font-size: 2rem;font-weight: 600;padding-bottom: 20px;color: black" id="login-title">
                    ورود به حساب کاربری
                </h>
                <p style="text-align: center;font-size: 13px;font-weight: 500;padding-bottom: 10px;color: black" class="d-none d-md-block">
                    به {{\App\Models\Setting::latest()->first()->system_name ?? ''}} خوش آمدید
                </p>
                <form class="form" method="post" action="{{ route('auth.login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column w-100 align-items-center justify-content-center">
                            <div class="form-group">
{{--                                <h6 style="color: darkred;text-align: center;font-size: 14px;" class="mt-2" id="errMessage">! شماره تلفن وارد شده معتبر نیست </h6>--}}
                                <input type="text" name="username" class="form-control " id="" placeholder="شماره همراه یا ایمیل " style="min-height: 50px; border: 1px gray solid;text-align: center;font-size: 14px;max-width: 330px;border-radius: 10px;-webkit-box-shadow: inset 0 0 0 30px #fff !important;padding: 19px 20px;"  required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control " id="" placeholder="رمز عبور" style="min-height: 50px; border: 1px gray solid;text-align: center;font-size: 14px;max-width: 330px;border-radius: 10px;-webkit-box-shadow: inset 0 0 0 30px #fff !important;padding: 19px 20px;"  required>
                            </div>
                             <div class="form-group">
                                    <div class="d-flex flex-row align-items-center justify-content-between" id="captchaContainer">
{{--                                        @captcha--}}
                                        <img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/default?'+Math.random()"  alt="captcha" id="captchaCode" >
{{--                                        <button type="button" class="btn btn-info btn-sm" onclick="$('#captchaContainer>img').attr('src','https://press.persiandade.ir/captcha/image?_=1267098935&amp;_='+Math.random());var captcha=document.getElementById('captcha');if(captcha){captcha.focus()}"> <i class="feather icon-refresh-cw"></i> </button>--}}
                                        <a type="button" href="javascript:;" class="btn btn-info btn-sm" onclick="document.getElementById('captchaCode').src='/captcha/default?'+Math.random()"> <i class="feather icon-refresh-cw"></i> </a>
                                    </div>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control mt-2">
                            </div>

                        </div>
                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            <button  class="btn btn-warning" id="" style="min-width: 250px;border-radius: 15px" type="submit">
                                ورود  <i class="feather icon-check-circle"></i>
                            </button>
                        </div>

                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-3">
                            <h5 style="text-align: right;font-weight: 500">حساب کاربری ندارید؟ <a href="{{route('register.mobile')}}" wire:navigate>ثبت‌ نام</a></h5>
                        </div>

                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-3">
                            <a href="{{route('reset-password.form')}}" style="font-size: 13px" wire:navigate>فراموشی رمز عبور</a>
                        </div>


                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            <div class="spinner mt-2  d-none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="confirmCode" class="d-none">
            <div  class="d-flex flex-column w-100 h-100 ">
                <h style="text-align: center;font-size: 2rem;font-weight: 600;padding-bottom: 20px;color: black" id="login-title">
                    ثبت کد تایید
                </h>
                <p style="text-align: center;font-size: 13px;font-weight: 500;padding-bottom: 10px;color: black" class="">
                    .کد دریافتی را وارد نمایید
                </p>

                <p style="text-align: center;font-size: 14px;font-weight: 500;padding-bottom: 10px;color: darkcyan;cursor:pointer;" onclick="editNumber()" >

                    ویرایش شماره
                    <span id="numberContainer"></span>

                    <i class="feather icon-edit"></i>
                </p>


                <form class="form" method="post" action="">
                    <div class="row">
                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center">
                            <div class="form-group">
                                <input type="text" name="" class="form-control" id="verificationCode" maxlength="6" placeholder="کد تایید را وارد نمایید" style="min-height: 50px; border: 1px gray solid;text-align: center;font-size: 14px;max-width: 310px;border-radius: 10px;-webkit-box-shadow: inset 0 0 0 30px #fff !important;padding: 19px 30px;"  required>
                                <h6 style="color: darkred;text-align: center;font-size: 14px;" class="mt-2 d-none" id="CodeErrorMessage">!کد وارد شده اشتباه است. </h6>
                            </div>
                        </div>

                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            {{--                            <p style="font-size: 12px;color: #6a5e5e" id="timeContainer">--}}
                            {{--                                     <span id="time"></span>--}}
                            {{--                            </p>--}}
                            <a style="font-size: 12px;cursor: pointer" href="" id="sendCodeAgain" class="">
                                ارسال مجدد کد
                            </a>
                        </div>
                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            <button href="" class="btn btn-warning" id="" style="min-width: 250px;border-radius: 15px" onclick="" type="button">
                                ورود  <i class="feather icon-check-circle"></i>
                            </button>
                        </div>

                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            <div class="spinner mt-2  d-none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>

    </div>

    @slot('script')
        <script>
            $(window).load(function() {
                $('#navigation-menu').addClass("smaller")
                // $('#captchaContainer>img').addClass('mt-5')

            });
            // Set the date we're counting down to

            function countdownTimeStart(status){
                var downloadTimer;
                var timeleft = 12;
                downloadTimer = setInterval(function () {

                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        $('#timeContainer').addClass('d-none');
                        $('#sendCodeAgain').removeClass('d-none');
                    } else {
                        document.getElementById("time").innerHTML = " تا ارسال مجدد :‌" + timeleft + " ثانیه";
                    }
                    timeleft -= 1;
                }, 1000);
            }


            $("#comment-btn").click(function() {
                // console.log($("#customers").offset().top)
                $('html, body').animate({
                    scrollTop: $("#comments").offset().top - 140
                }, 1333);
            });
            $("#about").click(function() {
                // console.log($("#customers").offset().top)
                $('html, body').animate({
                    scrollTop: $("#about-book").offset().top - 140
                }, 1333);
            });

            //check input value and send verification code
            function sendMessage() {
                var phoneNumber = $('#phone').val()
                var phoneNumberLength = phoneNumber.replace(/\s+/g, '').length
                if (phoneNumber !== "" && $.isNumeric(phoneNumber) && phoneNumberLength == "11"){
                    $("#errMessage").addClass('d-none'); //hide error
                    //phone number is okay and code sent
                    $('#phoneNumber').addClass('d-none')
                    $('#confirmCode').removeClass('d-none')
                    $('#numberContainer').text(phoneNumber)
                    // countdownTimeStart(false)
                }else{
                    $("#errMessage").removeClass('d-none'); //Show error

                }

            }
            function editNumber() {

                $('#phoneNumber').removeClass('d-none')
                $('#confirmCode').addClass('d-none')
            }


        </script>
    @endslot
@endcomponent
