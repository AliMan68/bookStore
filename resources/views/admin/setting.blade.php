@component('admin.layouts.content',['title'=>'مدیریت تنظیمات'])

    @slot('title')
        مدیریت تنظیمات
    @endslot
    <ul  style="font-size: 12px;direction: rtl" class="text-black-50 text-right">
        <li>
            <p class="m-0">درج اطلاعات آیتم‌های ستاره دار اجباری می‌باشد</p>
        </li>
        <li>
            <p class="m-0" style="margin-bottom: 0!important;">جهت بروزرسانی اطلاعات کافی است مقادیر موجود را ویرایش نموده و ثبت نمایید.</p>
        </li>
    </ul>
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form class="form new-book" method="post" action="{{route('admin.setting.store')}}" >
                @csrf
                <div style="direction: rtl"  class="row p-1 py-3">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="system_name">*نام سامانه :</label>
                            <input type="text" id="system_name" class="form-control required" name="system_name" value="{{$setting->system_name ?? old('system_name')}}" placeholder="" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="address">*آدرس انتشارات :</label>
                            <input type="text" id="address" class="form-control required" name="address" value="{{$setting->address ?? old('address')}}" placeholder="" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="persons">مدیر انتشارات :</label>
                            <input type="text" id="persons" class="form-control " name="persons" value="{{$setting->persons ?? old('persons')}}" placeholder="" >
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="phone">شماره تماس انتشارات :</label>
                            <input type="text" id="phone" class="form-control required" name="phone" value="{{$setting->phone ?? old('phone')}}" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">ایمیل انتشارات :</label>
                            <input type="text" id="email" class="form-control " name="email" value="{{$setting->email ?? old('email')}}" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="postPrice"> هزینه پست(تومان) :</label>
                            <input type="number" required id="postPrice" class="form-control " name="post_price" value="{{$setting->post_price ?? old('post_price')}}" placeholder="عدد وارد نمایید">
                        </div>
                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-plus-circle"></i>ثبت تنظیمات
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endcomponent
