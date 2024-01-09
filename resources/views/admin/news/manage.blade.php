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
            <form class="form new-book" method="post" action="{{route('admin.news.store')}}" enctype="multipart/form-data">
                @csrf
                <div style="direction: rtl" class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="title">*عنوان خبر :</label>
                            <input type="text" id="name" class="form-control required" name="title" value="" placeholder="مثلا راه‌اندازی سامانه انتشارات دانشگاه" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="siteLogo" style="font-size: 11px">*تصویر خبر:</label>
                            <input type="file" id="siteLogo" class="form-control " name="image" required >
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="siteLogo" style="font-size: 11px">پیوست خبر :</label>
                            <input type="file" id="siteLogo" class="form-control " name="attachment" >
                        </div>
                    </div>
                    {{--                                <div class="divider"></div>--}}
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="editor2">*محتوای خبر :</label>
                            <textarea name="description" id="editor2" rows="7" required style="font-size: 13px"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-check-circle"></i> ثبت خبر
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <h5>لیست اخبار</h5>
            @if($news->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="users">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="max-width: 180px">عنوان خبر</th>
                        <th scope="col">تاریخ ثبت</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">پیوست</th>
                        <th scope="col" style="min-width: 120px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $news)
                        <tr class="">
                            <td scope="row">{{$loop->index + 1}}</td>
                            <td style="min-width: 100px!important;font-size: 12px">
                                <p class="text-justify">{{$news->title}}</p>
                            </td>
                            <td>{{$news->created_at}}</td>
                            <td>
                                @if(strlen($news->image)<1)
                                    درج نشده
                                @else
                                    <img src="{{asset($news->image)}}" style="height: auto;width: auto;max-width: 160px;max-height: 80px;border-radius: 3px;border: 1px darkblue solid" alt="{{$news->title}}">
                                @endif
                            </td>
                            <td>
                                @if(strlen($news->attachment)<1)
                                    ندارد
                                @else
                                    <a href="{{asset($news->attachment)}}" donwnload><i class="feather icon-download"></i></a>
                                @endif
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#confirmModal{{$news->id}}" class="btn btn-danger"> <i class="feather icon-trash"></i>  </button>
                                <button data-toggle="modal" data-target="#editModal{{$news->id}}" class="btn btn-info"> <i class="feather icon-edit"></i>  </button>
                            </td>
                        </tr>
                        <div class="modal fade " id="editModal{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="editModal{{$news->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">ویرایش خبر </h5>
                                        <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="form new-book" method="post" action="{{route('admin.news.update',$news)}}" enctype="multipart/form-data">
                                        <div class="modal-body " style="color:black;text-align: right">
                                            <div class="d-flex flex-column w-10 align-items-center justify-content-around">
                                                @csrf
                                                <div style="direction: rtl" class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="title">*عنوان خبر :</label>
                                                            <input type="text" id="name" class="form-control text-right required" name="title" value="{{$news->title}}" placeholder="مثلا راه‌اندازی سامانه انتشارات دانشگاه" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 d-flex w-100 align-items-center justify-content-between">
                                                        <div class="form-group w-50">
                                                            <label for="siteLogo" style="font-size: 11px">*تصویر خبر(در صورت عدم انتخاب،تصویر قبلی باقی می‌ماند):</label>
                                                            <input type="file" id="siteLogo" class="form-control text-right " name="image"  >

                                                        </div>
                                                        @if(strlen($news->image)<1)
                                                            درج نشده
                                                        @else
                                                            <img src="{{asset($news->image)}}" style="width: auto;height: auto;max-width: 324px;max-height: 162px;border-radius: 3px;border: 1px darkblue solid" alt="{{$news->title}}">
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="siteLogo" style="font-size: 11px">پیوست خبر : @if(strlen($news->attachment)>1)
                                                                    <a href="{{asset($news->attachment)}}" donwnload><i class="feather icon-download"></i></a>
                                                                @endif
                                                            </label>
                                                            <input type="file" id="siteLogo" class="form-control  text-right " name="attachment" >
                                                        </div>
                                                    </div>
                                                    {{--                                <div class="divider"></div>--}}
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="editor2">*محتوای خبر :</label>
                                                            <textarea name="description" class=" text-right " id="editor2" rows="8" required style="font-size: 13px">{{$news->description}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-md-3 m-auto col-sm-12">
                                                <div class="form-group">
                                                    <button class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                                        <i class="feather icon-edit-circle"></i> ویرایش خبر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade " id="confirmModal{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModal{{$news->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">حذف خبر </h5>
                                        <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body " style="color:black;">
                                        <div class="d-flex flex-column w-10 align-items-center justify-content-around">
                                            <p style="color: darkred;font-size: 1.8rem">
                                                هشدار!
                                            </p>
                                            <p class="text-center">
                                                آیا از حذف این کتاب اطمینان دارید؟ <br> این عمل غیرقابل بازگشت خواهد بود.
                                            </p>
                                            <p style="font-size: 11px;text-align: right">
                                                عنوان خبر : {{$news->title}}
                                            </p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex w-100 align-items-center justify-content-around">
                                            <form action="{{route('admin.news.destroy',$news)}}" method="post">
                                                @csrf
                                                <button class="btn btn-success"> <i class="feather icon-check-circle"></i> بله </button>
                                                @method('DELETE')
                                            </form>

                                            <button href="" class="btn btn-danger" data-dismiss="modal" aria-label="Close"> <i class="feather icon-slash"></i> خیر </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </tbody>
                </table>
            @else
                <div class="content-body my-5" style="margin-top: 7rem">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <i class="feather icon-alert-circle mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>تاکنون خبری ثبت نشده</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @slot('script')
        <script>
            CKEDITOR.replace('editor3');
        </script>
    @endslot
@endcomponent
