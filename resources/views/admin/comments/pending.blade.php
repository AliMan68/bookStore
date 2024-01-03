@component('admin.layouts.content',['title'=>'نظرات بررسی نشده'])


    @slot('headerTitle')
        بررسی نظرات
    @endslot
    <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
        <li>
            <p class="m-0">در این بخش امکان ثبت بررسی نظرات ثبت شده برای هر کتاب وجود دارد</p>
        </li>
        <li>
            <p style="margin-bottom: 0!important;">میتوانید نظرات ثبت شده را از بخش مدیریت نظرات حذف کنید</p>
        </li>
    </ul>
        <div class="card p-2" style="text-align: right;direction: rtl">
            <div class="card-content table-responsive d-block">

                @if($comments->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="min-width: 80px;">کاربر</th>
                        <th scope="col">نظر کاربر</th>
                        <th scope="col">کتاب</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col" style="min-width: 150px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)
                        <tr class="">
                            <td scope="row">{{$loop->index+1}}</td>
                            <td>
                                {{$comment->user->name}}<br>
                            </td>
                            <td>{{$comment->comment}}</td>
                            <td><a href="{{route('book.details',$comment->commentable->id)}}" target="_blank">{{$comment->commentable->title}}</a></td>
                            <td>{{jdate($comment->created_at)}}</td>
                            <td>
                                <div class="d-flex flex-row justify-content-between">
                                    <form action="{{route('admin.comments.confirm',$comment->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-success btn-sm"> <i class="feather icon-check"></i> تایید </button>
                                    </form>
                                    <form action="{{route('admin.comments.reject',$comment->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-sm"> <i class="feather icon-trash-2"></i> رد </button>
                                    </form>
                                </div>


                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                    <div class="col-12">
                        <div class="card-footer">
                            {{$comments->render('pagination::bootstrap-4')}}
                        </div>
                    </div>

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
