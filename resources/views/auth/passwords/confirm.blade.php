@component('site.layout.content',['title'=>'تایید شماره موبایل'])
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
            <form class="form w-100 mb-10" method="post" action="{{route('reset-password.reset')}}">
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
                    <img alt="Logo" class="mh-125px" src="{{asset('/images/logo.png')}}" width="100"/>
                </div>
                <!--end::Icon-->
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h4 class="text-dark mb-3">تایید کد ارسال شده</h4>

                </div>
                <!--end::Heading-->
                <!--begin::Section-->
                <div class="mb-10 px-md-10">
                    <input type="number" name="code" class="form-control form-control-solid text-center border-primary border-hover mx-1 my-2" id="user-name " placeholder="کد تایید را وارد نمایید" style="height: 45px" required>
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
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
@endcomponent
