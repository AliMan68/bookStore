@component('admin.layouts.content',['title'=>'مدیریت مترجمان'])

    @slot('headerTitle')
        مدیریت مترجمان
    @endslot

    <div class="card" style="text-align: right;">
     <div class="card-content px-2">
         <form class="form new-book" method="post" action="{{route('admin.translators.store')}}"  enctype="multipart/form-data">
             @csrf
             <div style="direction: rtl"  class="row p-1 py-3">
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group">
                         <label for="bookTitle">*نام مترجم(غیرتکراری باشد)‌ :</label>
                         <input type="text" id="bookTitle" class="form-control required" name="title" value="{{old('title')}}" placeholder="اجباری" required>
                     </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                     <div class="form-group">
                         <label for="bookTitle">توضیح دسته‌بندی‌ :</label>
                         <input type="text" id="bookTitle" class="form-control " name="description" value="{{old('description')}}" placeholder="اختیاری">
                     </div>
                 </div>
                 <div class="col-md-4 m-auto col-sm-12">
                     <div class="form-group">
                         <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                             <i class="feather icon-plus-circle"></i>ثبت مترجم
                         </button>
                     </div>
                 </div>
             </div>
         </form>
     </div>
 </div>

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            @if($translators->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="min-width: 80px;">نام مترجم</th>
                        <th scope="col" style="min-width: 80px;">توضیح مترجم</th>
                        <th scope="col" style="min-width: 122px">تعداد کتاب</th>
                        <th scope="col" style="min-width: 122px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach($translators as $translator)
                        <tr class="">
                            <td scope="row">{{$i++}}</td>
                            <td>
                                {{$translator->title}}
                            </td>
                            <td>{{$translator->description}}</td>
                            <td>{{$translator->books()->count()}}</td>
                            <td>
                                <button  data-toggle="modal" data-target="#confirmModal{{$translator->id}}" class="btn btn-danger"> <i class="feather icon-trash"></i> </button>
                            </td>
                        </tr>
                        <div class="modal fade " id="confirmModal{{$translator->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModal{{$translator->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">حذف مترجم {{$translator->title}}</h5>
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
                                                آیا از حذف این مترجم اطمینان دارید؟ <br> این عمل غیرقابل بازگشت خواهد بود.
                                            </p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex w-100 align-items-center justify-content-around">
                                            <form action="{{route('admin.translators.destroy',$translator->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-success"> <i class="feather icon-check-circle"></i> بله </button>
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
                        <i class="fa fa-shopping-bag mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>موردی وجود ندارد</h1>
                    </div>
                </div>
            @endif


        </div>
    </div>


@endcomponent
