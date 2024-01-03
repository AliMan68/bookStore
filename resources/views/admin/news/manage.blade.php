@component('admin.layouts.content',['title'=>'مدیریت اخبار و اطلاعیه'])

    @slot('headerTitle')
        مدیریت اخبار و اطلاعیه
    @endslot
    <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
        <li>
            <p class="m-0">در این بخش امکان ثبت و مدیریت مدیریت اخبار و اطلاعیه دیده شده است.</p>
        </li>
    </ul>

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <form class="form new-book" method="post" action="">
                <div style="direction: rtl" class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <label for="name">*عنوان خبر :</label>
                            <input type="text" id="name" class="form-control required" name="name" value="" placeholder="مثلا راه‌اندازی سامانه انتشارات دانشگاه" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="siteLogo" style="font-size: 11px">تصویر خبر(ترجیحا مستطیل شکل باشد) :</label>
                            <input type="file" id="siteLogo" class="form-control " name="" >
                        </div>
                    </div>
                    {{--                                <div class="divider"></div>--}}
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="editor2">*محتوای خبر :</label>
                            <textarea name="" id="editor2" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-check-circle"></i> ثبت اطلاعات
                            </button>
                        </div>
                    </div>
                </div>
            </form>
{{--            @if($news->count() > 0)--}}
            <h5>لیست اخبار</h5>
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="users">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="max-width: 180px">عنوان خبر</th>
                        <th scope="col">تاریخ ثبت</th>
                        <th scope="col">تصویر</th>
                        <th scope="col" style="min-width: 120px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="">
                        <td scope="row">۱</td>
                        <td style="min-width: 120px!important;">
                            <p class="text-justify">سامانه انتشارات دانشگاه راه‌اندازی شد.سامانه انتشارات دانشگاه راه‌اندازی شد</p>
                        </td>
                        <td>۱۴۰۰/۱۲/۰۲</td>
                        <td>
                            <img src="{{asset('/images/book2.jpg')}}" style="max-width: 80px;max-height: 60px;width: auto;height: auto" alt="عنوان خبر">
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#remove" class="btn btn-danger"> <i class="feather icon-slash"></i> حذف </button>
                            <button data-toggle="modal" data-target="#edit" class="btn btn-info"> <i class="feather icon-edit"></i> ویرایش </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
{{--            @else--}}
                <div class="content-body my-5" style="margin-top: 7rem">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-percent mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>موردی وجود ندارد</h1>
                    </div>
                </div>
{{--            @endif--}}
        </div>
    </div>
    @slot('script')
        <script>
            CKEDITOR.replace('editor3');
        </script>
    @endslot
@endcomponent
