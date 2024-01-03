@component('admin.layouts.content',['title'=>'درخواست‌های چاپ'])

    @slot('action')
        <a class="btn btn-info text-white" style="min-width: 130px;font-size: 11px!important;" href="{{route('admin.publish-request.create')}}">درخواست جدید <i class="feather icon-plus-circle"></i>  </a>
    @endslot
    @slot('headerTitle')
        درخواست‌های چاپ
    @endslot
    <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
        <li>
            <p class="m-0">در این بخش امکان ثبت درخواست‌های چاپ با استفاده از گزینه درخواست جدید وجود دارد</p>
        </li>
        <li>
            <p style="margin-bottom: 0!important;">میتوانید کتاب‌های موجود در هر درخواست را ثبت نمود</p>
        </li>
    </ul>

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            @if($requests->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl;text-align: right" id="deliver">
                    <thead>
                    <tr>
                        <th scope="col">شماره</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">مبلغ کل</th>
                        <th scope="col">پیوست</th>
                        <th scope="col" style="min-width: 120px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr class="">
                            <td>{{$request->request_number}}</td>
                            <td>{{jdate($request->request_date)->format('y-m-d')}}</td>
                            <td>{{($request->total_amount)}}</td>
                            <td>
                                @if($request->attachment != null)
                                    <a href="{{Illuminate\Support\Facades\URL::to('/') .'/'.$request->attachment}}" download><i class="feather icon-download"></i> دریافت </a>
                                @else
                                    ندارد
                                @endif
                            </td>
                            <td>
                                <button  data-toggle="modal" data-target="#confirmModal{{$request->id}}" class="btn btn-danger"><i class="feather icon-trash"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade " id="confirmModal{{$request->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModal{{$request->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">حذف درخواست شماره {{$request->request_number}} </h5>
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
                                                آیا از حذف اطمینان دارید؟ <br> این عمل غیرقابل بازگشت خواهد بود.
                                            </p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex w-100 align-items-center justify-content-around">
                                            <form action="{{route('admin.publish-request.destroy',$request->id)}}" method="post">
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
