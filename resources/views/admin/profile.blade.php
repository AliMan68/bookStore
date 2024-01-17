@component('admin.layouts.content',['title'=>'اطلاعات کاربری'])

    @slot('title')
        اطلاعات کاربری
    @endslot
    <ul  style="font-size: 12px;direction: rtl" class="text-black-50 text-right">
        <li>
            <p class="m-0">در این بخش امکان ویرایش اطلاعات کاربری وجود دارد.</p>
        </li>
        <li>
            <p class="m-0" style="margin-bottom: 0!important;">درج آیتم‌های ستاره‌دار اجباری است.</p>
        </li>
        <li>
            <p class="m-0" style="margin-bottom: 0!important;">در صورتی که قصد بروزرسانی رمز عبور را ندارید،ورودی را خالی بگذارید.</p>
        </li>
    </ul>
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form class="form new-book" method="post" action="{{route('admin.profile.update',auth()->user())}}" >
                @csrf
                <div style="direction: rtl" class="row p-1 py-3">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="name">*نام کامل :</label>
                            <input type="text" id="name" class="form-control required" name="name"  value="{{auth()->user()->name}}" placeholder="" required>
                        </div>
                    </div>
{{--                    <div class="col-md-4 col-sm-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="phone">*شماره تماس :</label>--}}
{{--                            <input type="number" id="phone" class="form-control required" name="phone" disabled   value="{{auth()->user()->phone}}" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 col-sm-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="email">*ایمیل :</label>--}}
{{--                            <input type="email" id="email" class="form-control required" name="email" disabled value="{{auth()->user()->email}}" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="password">تکرار رمزعبور :</label>
                            <input type="password" id="password" class="form-control " name="password" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="password_confirmation">تکرار رمزعبور :</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="col-md-4 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning mt-4" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-plus-circle"></i>ویرایش اطلاعات
                            </button>
                        </div>
                    </div>
                    <div class="divider"></div>

                </div>
            </form>
        </div>
    </div>

@endcomponent
