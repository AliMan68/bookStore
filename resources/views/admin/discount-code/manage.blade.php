@component('admin.layouts.content',['title'=>'مدیریت کد‌های تخفیف'])

    @slot('headerTitle')
        مدیریت کد‌های تخفیف
    @endslot
    <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
        <li>
            <p class="m-0">در این بخش امکان تعریف کد تخفیف وجود دارد</p>
        </li>
        <li>
            <p class="m-0">کد تخفیف باید حداقل ۳ حرف و حداکثر ۶ حرف باشد|درصد تخفیف بین ۱ تا ۹۹ وارد شود</p>
        </li>
        <li>
            <p style="margin-bottom: 0!important;">توجه فرمایید که کد تخفیف بر روی کل سبد کاربر اعمال می‌گردد.</p>
        </li>
    </ul>

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <form class="form mb-5" method="post" action="{{route('admin.discount-code.store')}}">
                @csrf
                <div style="direction: rtl" class="row px-2 pt-3">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="off-name">عنوان کد :</label>
                            <input type="text" id="off-name" class="form-control required" required name="code" value="" placeholder="حداکثر ۶ رقمی . مثلا off-10" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="percent">درصد کد تخفیف:</label>
                            <input type="number" id="percent" class="form-control required" required name="percent" value="" placeholder="عدد وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 ml-auto mt-3">
                        <button href="" class="btn btn-warning mt-3" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                            <i class="feather icon-check-circle"></i>ثبت
                        </button>
                    </div>
                </div>
            </form>
            @if($codes->count() > 0)
            <h5>کدهای تخفیف</h5>
            <table class="table  table-hover-animation table-striped mb-0 w-100 mt-5" style="direction: rtl" id="table">
                <thead>
                <tr>
                    <th scope="col">عنوان</th>
                    <th scope="col">تاریخ ثبت</th>
                    <th scope="col">درصد تخفیف%</th>
                    <th scope="col" style="min-width: 120px">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($codes as $code)
                    <tr>
                        <td>{{$code->code}}</td>
                        <td>{{jdate($code->sale_date)->format('y-m-d')}}</td>
                        <td>{{$code->percent}}</td>
                        <td>
                            <button href="" data-toggle="modal" data-target="#removeModal{{$code->id}}" class="btn btn-danger"> <i class="feather icon-trash"></i>  </button>
                        </td>
                    </tr>

                    <div class="modal fade " id="removeModal{{$code->id}}" tabindex="-1" role="dialog" aria-labelledby="removeModal{{$code->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">حذف کد تخفیف {{$code->code}}</h5>
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
                                            آیا از حذف این کد تخفیف اطمینان دارید؟ <br> این عمل غیرقابل بازگشت خواهد بود.
                                        </p>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex w-100 align-items-center justify-content-around">
                                        <form action="{{route('admin.discount-code.destroy',$code->id)}}" method="post">
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
                        <i class="fa fa-percent mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>موردی وجود ندارد</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endcomponent
