@component('admin.layouts.content',['title'=>'سفارشات من'])

    @slot('action')

    @endslot
    @slot('headerTitle')
        سفارشات من
    @endslot

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">

            @if($orders->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="table">
                    <thead>
                    <tr>
                        <th scope="col">شماره سفارش</th>
                        <th scope="col" style="min-width: 80px;">تاریخ ثبت</th>
                        <th scope="col">وضعیت سفارش</th>
                        <th scope="col">جزییات سفارش</th>
                        <th scope="col">کد رهگیری</th>
{{--                        <th scope="col" style="min-width: 122px">عملیات</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="">
                            <td scope="row">{{$order->id}}</td>
                            <td>
                                {{jdate($order->created_at)->format('%d %B %Y')}}
                            </td>
                            <td style="font-size: 12px">
                                @if($order->status == 'delivered')
                                    تحویل شد
                                @elseif($order->status == 'completed')
                                در انتظار تحویل/ارسال
                                @elseif($order->status == 'canceled')
                                لغو شده
                                @elseif($order->status == 'else')
                                نامشخص
                                @elseif($order->status == 'unpaid')
                                پرداخت نشده
                                @endif

                            </td>
                            <td>
                                <button  data-toggle="modal" data-target="#orderDetails{{$order->id}}" class="btn btn-warning btn-sm" style="font-size: 10px!important;"> <i class="feather icon-eye"></i> مشاهده </button>
                            </td>
                            <td style="font-size: 12px">{{($order->delivery_type == 'in_post') ? ($order->tracking_code ?? 'ثبت نشده') : 'تحویل حضوری'}}</td>
{{--                            <td>--}}
{{--                                <button  data-toggle="modal" data-target="#confirmModal" class="btn btn-danger"> <i class="feather icon-trash"></i> </button>--}}
{{--                                <a href="" class="btn btn-info"> <i class="feather icon-edit"></i></a>--}}
{{--                                @if($order->status == 'unpaid')--}}
{{--                                    <button  data-toggle="modal" data-target="#rePay{{$order->id}}" class="btn btn-success btn-sm" style="font-size: 10px!important;"> <i class="feather icon-dollar-sign"></i> پرداخت </button>--}}
{{--                                @endif--}}
{{--                            </td>--}}
                        </tr>
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
                @if($orders->count() > 0)
                  @foreach($orders as $order)
                        <div class="modal fade " id="orderDetails{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderDetails{{$order->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                            <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                <h5 class="modal-title" id="exampleModalCenterTitle">جزییات سفارش شماره : {{$order->id}}</h5>
                                <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body " style="color:black;">
                                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                                    <thead>
                                    <tr>
                                        <th scope="col">عنوان کتاب</th>
                                        <th scope="col" style="min-width: 80px;">مبلغ</th>
                                        <th scope="col" style="min-width: 80px;">تعداد</th>
                                        <th scope="col" style="min-width: 122px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->books()->get() as $book)
                                        <tr>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->price}}</td>
                                            <td>{{$book->pivot->quantity}}</td>
                                            <td>---</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                        @if($order->status == 'unpaid')
                        <div class="modal fade " id="rePay{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="rePay{{$order->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">پرداخت مجدد سفارش شماره : {{$order->id}}</h5>
                                        <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body " style="color:black;">
                                        @if($order->books()->count())
                                         <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                                            <thead>
                                                <tr>
                                                    <th scope="col">عنوان کتاب</th>
                                                    <th scope="col" style="min-width: 80px;">مبلغ</th>
                                                    <th scope="col" style="min-width: 80px;">تعداد سفارش</th>
                                                    <th scope="col" style="min-width: 80px;">وضعیت موجودی</th>
                                                    <th scope="col" style="min-width: 122px">مبلغ کل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php($totalPrice=0)

                                              @foreach($order->books()->get() as $book)
                                                <tr>
                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->price}}</td>
                                                    <td>{{$book->pivot->quantity}}</td>
                                                    <td >
                                                        @if($book->count >= $book->pivot->quantity)
                                                            <i class="feather icon-check-circle" style="color: green"></i> موجود
                                                        @else
                                                            <i class="feather icon-slash" style="color: red"></i> ناموجود
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($book->count >= $book->pivot->quantity)
                                                          {{number_format(($book->pivot->quantity * $book->price))}}
                                                            @php($totalPrice = $totalPrice + ($book->pivot->quantity * $book->price))

                                                        @else
                                                            <i class="feather icon-slash" style="color: red"></i> ناموجود
                                                        @endif
                                                    </td>
                                                </tr>

                                            @endforeach
                                              <tfooter>
                                                  <tr>
                                                      <td>مبلغ کل :</td>
                                                      <td></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td>{{number_format($totalPrice)}}</td>
                                                  </tr>
                                              </tfooter>

                                            </tbody>

                                        </table>
                                        @else
                                            کتابی موجود نیست!
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <a href="{{route('admin.order.payment',$order->id)}}" class="btn btn-sm btn-success"> <i class="feather icon-check"></i> پرداخت </a>
                                            <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            {{$orders->render()}}
        </div>
    </div>
    @slot('style')

        <link rel="stylesheet" type="text/css" href="{{asset('site-css/jquery.dataTables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('site-css/buttons.dataTables.min.css')}}">
    @endslot
    @slot('script')

        <script src="{{asset('css/template/app-assets/js/dataTable/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/buttons.flash.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/jszip.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/buttons.flash.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/buttons.html5.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/buttons.print.min.js')}}"></script>
        <script src="{{asset('css/template/app-assets/js/dataTable/jquery.easing.min.js')}}"></script>
        <script>
            // $('#book').select2();
            $.extend( true, $.fn.dataTable.defaults, {
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "info": "نمایش _START_ تا _END_ از _TOTAL_ ردیف",
                    "infoEmpty": "نمایش 0 تا 0 از 0 ردیف",
                    "infoPostFix": "",
                    "infoFiltered": "(فیلتر شده از _MAX_ ردیف)",
                    "loadingRecords": "در حال بارگزاری...",
                    "lengthMenu": "نمایش _MENU_ ردیف",
                    "paginate": {
                        "first": "برگه‌ی نخست",
                        "last": "برگه‌ی آخر",
                        "next": "بعدی",
                        "previous": "قبلی"
                    },
                    "processing": "در حال پردازش...",
                    "search": "جستجو:",
                    "searchPlaceholder": "",
                    "zeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "emptyTable": "",
                    "aria": {
                        "sortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sortDescending": ": فعال سازی نمایش به صورت نزولی"
                    },
                    //only works for built-in buttons, not for custom buttons
                    "buttons": {
                        "create": "Neu",
                        "edit": "Ändern",
                        "remove": "Löschen",
                        "copy": "Kopieren",
                        "csv": "CSV-Datei",
                        "excel": "Excel-Tabelle",
                        "pdf": "PDF-Dokument",
                        "print": "Drucken",
                        "colvis": "Spalten Auswahl",
                        "collection": "Auswahl",
                        "upload": "Datei auswählen...."
                    },
                    "select": {
                        "rows": {
                            _: '%d Zeilen ausgewählt',
                            0: 'Zeile anklicken um auszuwählen',
                            1: 'Eine Zeile ausgewählt'
                        }
                    }
                }
            } );

            $(document).ready(function() {

                var table = $('#table').DataTable({
                        dom: 'Bfrtip',
                        language: {
                            searchPlaceholder: ""
                        },
                        "buttons": [
                            {extend: 'copy',text: 'کپی',exportOptions: {columns: [':visible']},title: ' '},
                            {extend: 'excel',text: 'اکسل',exportOptions: {columns: [    ':visible']},title: ' '},
                            // {extend: 'pdf',text: 'پی دی اف',exportOptions: {columns: ':visible'},
                            //     customize: function (doc) {
                            //         doc.defaultStyle.font = 'Vazir';
                            //         doc.defaultStyle.fontSize = 8;
                            //         doc.content[0].alignment = 'center';
                            //         doc.content[1].alignment = 'center';
                            //         },},
                            {extend: 'print',text: 'پرینت',exportOptions: {columns: [':visible']},title: ''}],
                        searching: true,
                        iDisplayLength: 100,
                    }
                );

            } );
        </script>

    @endslot

@endcomponent

