@component('admin.layouts.content',['title'=>'مدیریت کتاب‌ها'])

    @slot('action')
        <a class="btn btn-info text-white" style="min-width: 130px" href="{{route('admin.books.create')}}">کتاب جدید <i class="feather icon-plus-circle"></i>  </a>
    @endslot
    @slot('headerTitle')
        مدیریت کتاب‌ها
    @endslot

        <div class="card p-2" style="text-align: right;direction: rtl">
            <div class="card-content table-responsive d-block">

                @if($books->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="min-width: 80px;">نام کتاب</th>
                        <th scope="col">موجودی</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">درصد تخفیف</th>
                        <th scope="col">تصویر</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 0)
                    @foreach($books as $book)
                        <tr class="">
                            <td scope="row">{{$i++}}</td>
                            <td>
                                <a href="#" target="_blank">{{$book->title}}</a><br>
                            </td>
                            <td>{{$book->count}}</td>
                            <td>{{number_format($book->price)}}</td>
                            <td>{{$book->discount_percent}}</td>

                            <td>
                                @if(strlen($book->image)<1)
                                    درج نشده
                                @else
                                <img src="{{asset($book->image)}}" style="width: 60px;height: 80px;border-radius: 3px;border: 1px darkblue solid" alt="{{$book->title}}">
                                @endif
                            </td>
                            <td>
                                 <i class="feather icon-trash"  data-toggle="modal" data-target="#confirmModal{{$book->id}}" style="color: darkred;cursor: pointer;font-size: 15px"></i>
                                <a href="{{route('admin.books.edit',$book->id)}}" class=""> <i class="feather icon-edit" style="font-size: 15px"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade " id="confirmModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModal{{$book->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">حذف کتاب {{$book->title}}</h5>
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

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex w-100 align-items-center justify-content-around">
                                            <form action="{{route('admin.books.destroy',$book->id)}}" method="post">
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
                            <i class="fa fa-shopping-bag mb-3" style="font-size: 3rem"></i>
                            <h1 class="text-black-50 text-center"><span></span>موردی وجود ندارد</h1>
                        </div>
                    </div>
                @endif


            </div>
        </div>


@endcomponent
