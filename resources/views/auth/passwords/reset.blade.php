@component('site.layouts.content',['title'=>'بازیابی رمز عبور'])
    @slot('headerTitle')
        تایید شماره موبایل
    @endslot
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->
        <a href="/" class="mb-12">
            <img alt="Logo" src="/" class="h-40px" />
        </a>
        <!--end::Logo-->
        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form method="post" action="{{route('reset-password.send-code')}}" class="form w-100" novalidate="novalidate" id="kt_password_reset_form">
                <div class=" flex-column align-items-between my-1 p-0">
                    @if(\Illuminate\Support\Facades\Session::get('fail'))
                        <h6 class=" m-auto alert alert-danger"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::get('success'))
                        <h6 class=" m-auto alert alert-success"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                    @endif
                </div>


                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">رمز عبور خود را فراموش کرده اید؟</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">شماره موبایل ثبت نامی خود را وارد نمایید.</div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <label class="form-label fw-bolder text-gray-900 fs-6">موبایل</label>
                    <input class="form-control form-control-solid" type="text" placeholder="09000000000" name="mobile" autocomplete="off" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">کد امنیتی</label>
                        <!--end::Label-->
                        <!--begin::Link-->
                        <img alt="برای نمایش صفحه را رفرش کنید" src="{{captcha_src()}}">
                        <!--end::Link-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Input-->
                    <input class="form-control form-control-lg form-control-solid required"  type="text" name="captcha" id="captcha"  required/>
                    <!--end::Input-->
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
                        ارسال
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

