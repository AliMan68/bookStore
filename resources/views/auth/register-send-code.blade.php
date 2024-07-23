@component('site.layout.content',['title'=>'تایید شماره موبایل'])
    @slot('headerTitle')
        تایید شماره موبایل
    @endslot
    <div class="container" style="margin-top:10.5rem;height: auto;min-height: 260px">
        <div id="phoneNumber">
            <div class="d-flex flex-column w-100 h-100">
                <h style="text-align: center;font-size: 2rem;font-weight: 600;padding-bottom: 20px;color: black" id="login-title">
                    تایید شماره موبایل
                </h>
                <p style="text-align: center;font-size: 13px;font-weight: 500;padding-bottom: 10px;color: black" class="">
                    لطفا شماره موبایل خود را جهت دریافت کد تایید وارد نمایید
                </p>
                <form class="form" method="post" action="{{route('register.send-code')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center">
                            <div class="form-group">
                                <input type="text" name="mobile" class="form-control" id="phone" maxlength="11" placeholder="شماره همراه    " style="min-height: 50px; border: 1px gray solid;text-align: center;font-size: 14px;max-width: 310px;border-radius: 10px;-webkit-box-shadow: inset 0 0 0 30px #fff !important;padding: 19px 30px;"  required>
                                <h6 style="color: darkred;text-align: center;font-size: 14px;" class="mt-2 d-none" id="errMessage">! شماره تلفن وارد شده،معتبر نیست </h6>
                                <div class=" flex-column align-items-between my-1 p-0">
                                    @if(\Illuminate\Support\Facades\Session::get('fail'))
                                        <h6 class=" m-auto alert alert-danger"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Session::get('success'))
                                        <h6 class=" m-auto alert alert-success"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex w-100 align-items-center justify-content-center">
                            <div class="form-group">
                                <div class="d-flex flex-row align-items-center justify-content-between" id="captchaContainer">
{{--                                @captcha--}}
{{--                                    <button type="button" class="btn btn-info btn-sm" onclick="$('#captchaContainer>img').attr('src','https://press.persiandade.ir/captcha/image?_=1267098935&amp;_='+Math.random());var captcha=document.getElementById('captcha');if(captcha){captcha.focus()}"> <i class="feather icon-refresh-cw"></i> </button>--}}
                                    <img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/default?'+Math.random()"  alt="captcha" id="captchaCode" >

                                    <a type="button" href="javascript:;" class="btn btn-info btn-sm" onclick="document.getElementById('captchaCode').src='/captcha/default?'+Math.random()"> <i class="feather icon-refresh-cw"></i> </a>
                                </div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control mt-2">
                            </div>

                        </div>

                            <div class="col-md-12 d-flex w-100 align-items-center justify-content-center mt-2">
                            <button href="" class="btn btn-warning" id="" style="min-width: 250px;border-radius: 15px" onclick="" type="submit">
                                ادامه  <i class="feather icon-arrow-left-circle"></i>
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
            function sendMessage() {
                var phoneNumber = $('#phone').val()
                var phoneNumberLength = phoneNumber.replace(/\s+/g, '').length
                if (phoneNumber !== "" && $.isNumeric(phoneNumber) && phoneNumberLength == "11"){
                    $("#errMessage").addClass('d-none'); //hide error
                    //phone number is okay and code sent
                    $('#phoneNumber').addClass('d-none')
                    $('#confirmCode').removeClass('d-none')
                    $('#numberContainer').text(phoneNumber)

                    //call verification code api here
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
