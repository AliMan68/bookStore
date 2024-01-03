@component('admin.layouts.content',['title'=>'    ثبت فروش کتاب(در نمایشگاه‌ها یا  ...)'])
    @slot('headerTitle')
        ثبت فروش کتاب(در نمایشگاه‌ها یا ...)
    @endslot


        <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
            <li>
                <p class="m-0">در این بخش امکان ثبت فروش کتاب از سایر طرق دیده شده است</p>
            </li>
            <li>
                <p style="margin-bottom: 0!important;">در صورت لزوم می‌توانید موجودی انبار هر کتاب را با فروش بروز کنید.(میزان تحویل نباید بیش از موجودی باشد،در غیر این صورت اعمال نمی‌گردد)</p>
            </li>
        </ul>
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form class="form new-book" method="post" action="{{route('admin.other-sale.store')}}"  enctype="multipart/form-data">
                @csrf
                <div style="direction: rtl" class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="sale_title">*عنوان فروش :</label>
                            <input type="text" id="sale_title" class="form-control required" name="sale_title" value="" placeholder="مثلا نمایشگاه کتاب ۱۴۰۳" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="sale_date">*تاریخ فروش :</label>
                            <input type="text" id="sale_date" class="form-control required date-picker start-date" name="sale_date"   value="" placeholder="مثلا ۱۴۰۱/۱۲/۰۱" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="attachment">پیوست(نامه،اکسل فروش) :</label>
                            <input type="file" id="attachment" class="form-control " name="attachment" >
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-between" style="position: absolute;left: 10px;bottom: -20px">
                            <span ><i onclick="insertNewBook()" class="feather icon-plus-circle" data-toggle="tooltip" data-placement="left" title="انتخاب کتاب جدید" style="font-size: 1.7rem;color: darkcyan;cursor: pointer"></i></span>
                            <span ><i onclick="removeLastBook()" class="feather icon-minus-circle" data-toggle="tooltip" data-placement="left" title="حذف کتاب " style="font-size: 1.7rem;color: darkred;cursor: pointer"></i></span>
                        </div>
                    </div>
                    <div class="divider mt-3"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="book">*انتخاب کتاب : </label>
                            <select name="book[]" id="book"  class="form-control select2">
                                @foreach($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}} - موجودی {{$book->count}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="count">*تعداد :</label>
                            <input type="number" id="count" class="form-control required" name="count[]" value="0" placeholder="تعداد کتاب تحویلی" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="total_amount">*مبلغ کل :</label>
                            <input type="text" id="total_amount" class="form-control number-divider required" name="total_amount[]" value="0" placeholder="مبلغ کل" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="minus_stock">کسر از موجودی</label>
                            <select name="minus_stock[]" id="minus_stock">
                                <option value="0" selected>خیر</option>
                                <option value="1">بله</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-12" id="bookContainer">

                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-plus-circle"></i>ثبت فروش کتاب(ها)
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-2" style="text-align: right;">
        <p style="font-size: 1rem;text-align: right;color: black">لیست فروش</p>
        <div class="card-content table-responsive d-block">
            @if($sales->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl;text-align: right" id="deliver">
                    <thead>
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">کتاب‌ها</th>
                        <th scope="col">پیوست</th>

                        <th scope="col" style="min-width: 120px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr class="">

                            <td>{{$sale->sale_title}}</td>
                            <td>{{jdate($sale->sale_date)->format('y-m-d')}}</td>
                            <td style="min-width: 200px!important;">

                                @foreach($sale->books()->get() as $book)
                                    <a href="#" class="text-black">{{$book->title}} - {{$book->pivot->count}} عدد</a><br>
                                @endforeach
                            </td>
                            <td>
                                @if($sale->attachment != null)
                                    <a href="{{Illuminate\Support\Facades\URL::to('/') .'/'.$sale->attachment}}" download><i class="feather icon-download"></i> دریافت </a>
                                @else
                                    ندارد
                                @endif
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#confirmModal{{$sale->id}}" class="btn btn-danger"> <i class="feather icon-trash"></i>  </button>
                            </td>
                        </tr>
                        <div class="modal fade " id="confirmModal{{$sale->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmModal{{$sale->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">حذف فروش کتاب در   {{$sale->sale_title}} </h5>
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
                                            <form action="{{route('admin.other-sale.destroy',$sale->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-success"> <i class="feather icon-check-circle"></i> بله </button>
                                                @method('DELETE')
                                            </form>

                                            <button class="btn btn-danger" data-dismiss="modal" aria-label="Close"> <i class="feather icon-slash"></i> خیر </button>
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
    <div id="bookCountDeliver">1</div>

    @slot('script')

        <script>
            $('#book').select2()
            function insertNewBook() {
                let counter = parseInt($('#bookCountDeliver').text());
                counter = counter + 1;
                $('#bookCountDeliver').text(counter)
                const div = document.createElement('div');
                div.classList.add('row')
                div.classList.add('w-100')
                div.classList.add('px-0')
                div.setAttribute("id","bookItemContainer"+counter);
                div.innerHTML = `
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookTitle`+counter+`">*انتخاب کتاب  : </label>
                                        <select name="book[]" id="book`+counter+`"  class="form-control select2">
                                             @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}} - موجودی {{$book->count}}</option>
                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label for="count`+counter+`">*تعداد :</label>
                                        <input type="number" id="count`+counter+`" class="form-control required" name="count[]" value="" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="total_amount`+counter+`">*مبلغ کل :</label>
                            <input type="text" id="total_amount`+counter+`" class="form-control  required" name="total_amount[]" value="0" placeholder="مبلغ کل" required>
                        </div>
                    </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="wareHouse`+counter+`">کسر از موجودی</label>
                                        <select name="minus_stock[]" id="wareHouse`+counter+`">
                                            <option value="0" selected>خیر</option>
                                            <option value="1">بله</option>
                                        </select>
                                    </div>
                                </div>
`;

                document.getElementById('bookContainer').appendChild(div);
                activeSelect(counter)
            }
            function removeLastBook(){
                $('#bookContainer').children().last().remove();
            }
            function activeSelect(id){
                $('#book'+id).select2();
                $('#total_amount'+id).addClass('number-divider');
            }
        </script>
        @endslot


@endcomponent
