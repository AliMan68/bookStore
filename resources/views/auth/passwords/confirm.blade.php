@component('site.layouts.content',['title'=>'تایید شماره موبایل'])
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
        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100 mb-10" method="post" action="{{route('reset-password.reset')}}" novalidate="novalidate" id="kt_sing_in_two_steps_form">
                <div class=" flex-column align-items-between my-1 p-0">
                    @if(\Illuminate\Support\Facades\Session::get('fail'))
                        <h6 class=" m-auto alert alert-danger"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::get('success'))
                        <h6 class=" m-auto alert alert-success"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                    @endif
                </div>

                @csrf

                <input type="hidden" name="mobile" value="{{$mobile}}" >
                <!--begin::Icon-->
                <div class="text-center mb-10">
                    <img alt="Logo" class="mh-125px" src="/" />
                </div>
                <!--end::Icon-->
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">تایید کد ارسال شده</h1>
                    <!--end::Title-->
                    <!--begin::Sub-title-->
                    <div class="text-muted fw-bold fs-5 mb-5">کد تایید ارسالی را در کادر زیر وارد نمایید</div>
                    <!--end::Sub-title-->
                    <!--begin::Mobile no-->
                    <div class="fw-bolder text-dark fs-3">{{$mobile}}</div>
                    <!--end::Mobile no-->
                </div>
                <!--end::Heading-->
                <!--begin::Section-->
                <div class="mb-10 px-md-10">
                    <!--begin::Label-->
                    <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">کد تایید ۶رقمی ارسالی را وارد نمایید.</div>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <input type="number" name="code" class="form-control form-control-solid text-center border-primary border-hover mx-1 my-2" id="user-name " placeholder="کد تایید را وارد نمایید." style="height: 45px" required>

                    {{--                    <div class="d-flex flex-wrap flex-stack">--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="3" />--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="0" />--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="7" />--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />--}}
                    {{--                        <input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />--}}
                    {{--                    </div>--}}
                    <!--begin::Input group-->
                </div>
                <!--end::Section-->
                <!--begin::Submit-->
                <div class="d-flex flex-center">
                    <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                        ثبت
                    </button>
                </div>
                <div class=" flex-column align-items-between my-1 p-0">
                    <h6 class=" m-auto alert alert-success"> کد تایید با موفقیت به شماره {{$mobile}} ارسال شد</h6>
                </div>
                <!--end::Submit-->
            </form>
            <!--end::Form-->
            <!--begin::Notice-->
            {{--            <div class="text-center fw-bold fs-5">--}}
            {{--                <span class="text-muted me-1">کد تایید را دریافت نکردید؟</span>--}}
            {{--                <a href="#" class="link-primary fw-bolder fs-5 me-1">ارسال مجدد</a>--}}
            {{--            </div>--}}
            <!--end::Notice-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
@endcomponent
