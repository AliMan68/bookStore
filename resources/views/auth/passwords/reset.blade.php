@component('site.layout.content',['title'=>'بازیابی رمز عبور'])
    @slot('headerTitle')
        تایید شماره موبایل
    @endslot
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->

        <!--end::Logo-->
        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form method="post" action="{{route('reset-password.send-code')}}" class="form w-100" novalidate="novalidate" id="kt_password_reset_form">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h5 class="text-dark mb-3">شماره موبایل ثبت نامی خود را وارد نمایید</h5>
                    <!--end::Title-->
                    <!--begin::Link-->

                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">

                    <input class="form-control form-control-solid" type="text" placeholder="09000000000" name="mobile" autocomplete="off" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
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

                <!--end::Input group-->
                @error('captcha')
                <div class=" flex-column align-items-between my-1 p-0">
                    <h6 class=" m-auto alert alert-danger">{{ $message }}</h6>
                </div>
                @enderror



                <!--begin::Actions-->
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" class="btn btn-lg btn-primary w-100 mb-5 fw-bolder">
                        ارسال کد
                    </button>

                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
@endcomponent

