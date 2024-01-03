<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page-header')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->

    <!-- CSS Files

    ================================================== -->

    <link rel="stylesheet" type="text/css" href="{{asset('site-css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/bootstrap-grid.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/bootstrap-reboot.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/animate.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/owl.carousel.css')}}"  >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/owl.theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/owl.transitions.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/jquery.countdown.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('site-css/select/select2.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/vendors-rtl.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/persian-datepicker.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/jquery.dataTables.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/buttons.dataTables.min.css')}}" >


    <!-- color scheme -->
    <link id="colors" href="{{asset('site-css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/coloring.css')}}" />
    @yield('style')

</head>
<body class="" >
    <div id="wrapper" class="horizontal-layout horizontal-menu content-detached-left-sidebar ecommerce-application navbar-floating footer-static " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" style="min-height: 900px;
  background: rgba(0, 0, 0, 0) linear-gradient(155deg, rgba(8, 46, 198, 0.15) 4%, rgba(200, 150, 0, 0.18) 96%) repeat scroll 0% 0% / cover;
  padding-bottom: 100px !important;">
  @include('site.layouts.navbar')

      <div class="container" id="" style="margin-top:6.9rem;height: auto;min-height: 260px">

          @yield('content')
    </div>
      @include('site.layouts.footer')
</div>
<!-- ./wrapper -->
</body>
<!-- jQuery -->


<script src="{{asset('site-js/jquery.min.js')}}"></script>
<script src="{{asset('site-js/bootstrap.min.js')}}"></script>
<script src="{{asset('site-js/wow.min.js')}}"></script>
<script src="{{asset('site-js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('site-js/easing.js')}}"></script>
<script src="{{asset('site-js/owl.carousel.js')}}"></script>
<script src="{{asset('site-js/validation.js')}}"></script>
<script src="{{asset('site-js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('site-js/enquire.min.js')}}"></script>
<script src="{{asset('site-js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('site-js/jquery.plugin.js')}}"></script>
<script src="{{asset('site-js/typed.js')}}"></script>
<script src="{{asset('site-js/jquery.countTo.js')}}"></script>
<script src="{{asset('site-js/jquery.countdown.js')}}"></script>
<script src="{{asset('site-js/design.js')}}"></script>
<script src="{{asset('site-js/persianDatepicker.js')}}"></script>




<script src="{{asset('site-js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('site-js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('site-js/buttons.flash.min.js')}}"></script>
<script src="{{asset('site-js/jszip.min.js')}}"></script>
<script src="{{asset('site-js/buttons.flash.min.js')}}"></script>
<script src="{{asset('site-js/buttons.html5.min.js')}}"></script>
<script src="{{asset('site-js/buttons.print.min.js')}}"></script>
<script src="{{asset('site-js/jquery.easing.min.js')}}"></script>



<script src="{{ asset('site-js/persian-date.min.js') }}" ></script>
<script src="{{ asset('site-js/persian-datepicker.min.js') }}" ></script>
<script src="{{ asset('site-js/select/select2.full.min.js') }}" ></script>
<script src="{{ asset('site-js/persian-datepicker.min.js') }}" ></script>
<script  src="{{asset('site-js/swiper.min.js')}}"></script>
<script src="{{asset('css/template/app-assets/vendors/js/extensions/swiper.min.js')}}"></script>

<script src="{{asset('css/template/app-assets/js/scripts/extensions/swiper.js')}}"></script>
<script>

    $(window).load(function() {
        $('#navigation-menu').addClass("smaller")
    });
    $('#category').select2()
    $('#bookSection').select2()
    $('#bookTranslator').select2()
    $('#bookWriter').select2()
    function toggleFilters() {
        $('#filter-column').toggleClass('d-none')
    }
</script>

<script>
    (function ($) {
        $(document).ready(function () {
            $(function() {
                $('.date-picker').persianDatepicker({
                    formatDate: "YYYY/0M/0D"
                });
            });
        });
    })

    (window.jQuery);
    function toEnglishNumber(strNum) {
        var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        var an = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
        var cache = strNum;
        for (var i = 0; i < 10; i++) {
            var regex_fa = new RegExp(pn[i], 'g');
            var regex_ar = new RegExp(an[i], 'g');
            cache = cache.replace(regex_fa, en[i]);
            cache = cache.replace(regex_ar, en[i]);
        }
        return cache;
    }
    $('.number-divider').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        $(this).val(toEnglishNumber($(this).val()))
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
</script>
<script>
    setTimeout(function () {
        $('#messageNavigation').animate({right: "-240px",opacity : "0"},{
            duration: 100,
            easing: "linear"});
    },4500);
    function addToBag(bookName,author,image,price,id){

        if(document.cookie.indexOf('book'+id) == -1 ){
            var bookObject = [id,bookName,author,image,price];
            $.cookie('book' + id, JSON.stringify(bookObject), { path: '/' });
            createBook(id)
        }else{
            alert('کتاب در سبد خرید موجود است!')
        }


    }
    function createBook(id) {

        //add book count to badge and modal header counter
        var bagCount = parseInt($('#bagCount').text())
        bagCount = bagCount + 1;
        $('#bagCount').text(bagCount)
        $('#bagCount2').text(bagCount)
        $('#bagCount3').text(bagCount)
        $('#modalTitleCounter').text(bagCount)
        //create book object here to add bag modal
        var bookObject = JSON.parse($.cookie('book'+id));

        const div = document.createElement('div');
        div.classList.add('col-12')
        div.setAttribute("id","book"+id);
        div.innerHTML = `
                   <div class="d-flex flex-row align-items-center justify-content-around w-100 my-2 mb-1"  id="modal-book-card">
                        <a href="" target="_blank" style="max-height: 140px;max-width: 100px">
                        <span class="book-wrap" >
                            <img class=" book-hover"  src=`+bookObject[3]+`  alt="">
                        </span>
                        </a>
                        <div class="d-flex flex-column align-items-start" style="max-width: 35%" id="modal-book-card-text">
                            <p style="font-size: 13px;text-align: right;padding: 3px;padding-right: 10px;text-align: justify;color: black">
                                کتاب `+bookObject[1]+` اثر `+bookObject[2]+` <br>
                                    هر عدد : `+bookObject[4]+` تومان
                            </p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-around" style="min-height: 100px">

                            <a style="font-size: 10px;cursor: pointer;color: grey" class="mt-3" onclick="removeBook(`+bookObject[0]+`)"> <i class="feather icon-trash" style="font-size: 1.3rem;cursor:pointer;color: darkred" data-toggle="tooltip" data-placement="top" title="حذف"></i> حذف </a>
                        </div>
                    </div>
                   <hr style="border: 1px black dotted;margin: 0px!important;">
`;

        document.getElementById('book-container').appendChild(div);
        $('#addOverlayText'+bookObject[0]).css('font-size','11px')
        $('#addOverlayText'+bookObject[0]).text('به سبد خرید اصافه شد')
        checkCardCount()


    }

    function removeBook(id) {

        //remove from cookie
        $.removeCookie('book'+id, { path: '/' });
        // remove from bag modal
        $('#book'+id).remove()
        var bagCount = parseInt($('#bagCount').text())
        bagCount = bagCount - 1;
        $('#bagCount').text(bagCount)
        $('#bagCount2').text(bagCount)
        $('#bagCount3').text(bagCount)
        $('#modalTitleCounter').text(bagCount)
        $('#addOverlayText'+id).css('font-size','13px')
        $('#addOverlayText'+id).text('افزودن به سبد خرید')
        //check count to add or remove noIcon title and checkoutBtn
        checkCardCount()
    }


    function decodeCookie() {
        //get all cookies here and extract ones their name contains "book"
        var cookieParts = document.cookie.split(";"),
            cookies = {};

        for (var i = 1; i < cookieParts.length; i++) {
            var name_value = cookieParts[i],
                equals_pos = name_value.indexOf("="),
                name       = unescape( name_value.slice(0, equals_pos) ).trim(),
                value      = unescape( name_value.slice(equals_pos + 1) );
            //crate each book object and put them in modal bag
            createBook(name.replace(/book/gi, ''))
            cookies[":" + name] = value;
        }
        return cookies;
    }
    function findCookieByName(searchWord) {
        var cookies = decodeCookie();

        for (name in cookies) {
            var value = cookies[name];

            if (name.indexOf(":" + searchWord) == 0) {
                return value;
            }
        }
    }
    $( window ).load(function() {
        //get book cookies and add them to bag modal
        findCookieByName("book")
        console.log(findCookieByName("book"))

        checkCardCount()
    });
    function checkCardCount() {
        // console.log('number of child(es) is' + $("#book-container").children().length);
        if($("#book-container").children().length == 1){
            // remove no icon title in modal bag
            $('#noIcon').removeClass('d-none')
            $('#checkout-btn').addClass('d-none')
        }else{
            // remove no icon title in modal bag
            $('#noIcon').addClass('d-none')
            $('#checkout-btn').removeClass('d-none')
        }
    }
</script>

<script>
    $('.nav-container').on('click', function(event){

        $(this).find('ul').toggleClass('d-none')
        $(this).find('ul').toggleClass('update-height')

    });
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
</script>
@yield('script')
</html>
