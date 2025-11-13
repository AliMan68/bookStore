@component('admin.layouts.content',['title'=>'گزارش فروش'])
    @slot('headerTitle')
        گزارش فروش کتاب‌ها
    @endslot


    <ul class="text-black-50 text-right" style="font-size: 12px;direction: rtl">
        <li>
            <p class="m-0">در این بخش امکان مشاهده گزارش فروش برحسب کتاب یا در بازه زمانی مشخص وجود دارد.</p>
        </li>
        <li>
            <p style="margin-bottom: 0!important;">تاریخ را از تقویم انتخاب نمایید</p>
        </li>
    </ul>
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form class="form new-book" method="post" action="{{route('admin.report')}}">
                @csrf
                <div style="direction: rtl" class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">عنوان کتاب : </label>
                            <input type="text" id="title" class="form-control" name="title" value="{{request('title')}}" placeholder="بخشی از عنوان کتاب" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="sale_date">از تاریخ  :</label>
                            <input type="text" id="calendar" class="form-control required date-picker"  name="from_date" value="" placeholder="مثلا ۱۴۰۱/۱۲/۰۱" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="sale_date">تا تاریخ  :</label>
                            <input type="text" id="sale_date" class="form-control required date-picker" name="to_date" value="" placeholder="مثلا ۱۴۰۱/۱۲/۰۱" required>
                        </div>
                    </div>
                    <div class="divider mt-3"></div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="book_year">سال چاپ :</label>
                            <select name="book_year" id="book_year" class="form-control">
                                <option value="0" selected></option>
                                <option value="1384">1384</option>
                                <option value="1385">1385</option>
                                <option value="1386">1386</option>
                                <option value="1387">1387</option>
                                <option value="1389">1389</option>
                                <option value="1390">1390</option>
                                <option value="1391">1391</option>
                                <option value="1392">1392</option>
                                <option value="1393">1393</option>
                                <option value="1394">1394</option>
                                <option value="1395">1395</option>
                                <option value="1396">1396</option>
                                <option value="1397">1397</option>
                                <option value="1398">1398</option>
                                <option value="1399">1399</option>
                                <option value="1400">1400</option>
                                <option value="1401">1401</option>
                                <option value="1402">1402</option>
                                <option value="1403">1403</option>
                                <option value="1404">1404</option>
                                <option value="1405">1405</option>
                                <option value="1406">1406</option>
                                <option value="1407">1407</option>
                                <option value="1408">1408</option>
                                <option value="1409">1409</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookTurn">نوبت چاپ :</label>
                            <select name="credits" id="bookTurn" class="form-control">
                                <option value="0" selected></option>
                                <option value="اول">اول</option>
                                <option value="دوم">دوم</option>
                                <option value="سوم">سوم</option>
                                <option value="چهار">چهار</option>
                                <option value="پنجم">پنجم</option>
                                <option value="ششم">ششم</option>
                                <option value="هفتم">هفتم</option>
                                <option value="هشتم">هشتم</option>
                                <option value="نهم">نهم</option>
                                <option value="دهم">دهم</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning mt-1" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-search"></i>جستجو
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-2" style="text-align: right;">
        <div class="card-content table-responsive d-block">
            @if(count($orderDetails) > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl;text-align: right" id="table">
                    <thead>
                    <tr>
                        <th scope="col">کتاب</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">مبلغ(تومان)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $book=>$value)
                        <tr class="">
                            <td>{{$book}}</td>
                            <td>{{$value->sum('quantity')}}</td>
                            <td>{{number_format($value->sum('total_price'))}}</td>
{{--                            <td>{{number_format($value['price'] ?? 0)}}</td>--}}

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <div class="content-body my-5" style="margin-top: 7rem">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-search-minus mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>موردی یافت نشد</h1>
                    </div>
                </div>
            @endif

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
                    "search": "جستجو در نتایج:",
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
