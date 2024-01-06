<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>صفحه نخست - انتشارات دانشگاه صنعتی شریف</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <div class="no-bottom no-top" id="content" style="font-family: IranYekan!important;">
                <div class="position-relative" id="slider-section" >
                    <div class="gradient-overlay "></div>
                    <div class="hero" style="background-image: url('{{asset('/images/monitoring.jpeg')}}');">
                        <div class="overlay-gradient t50">
                            <div class="blog-slider">
                                <div class="blog-slider__wrp swiper-wrapper">
                                    <div class="blog-slider__item swiper-slide">
                                        <div class="blog-slider__img d-none">
                                            <img src="" alt="">
                                        </div>
                                        <div class="blog-slider__content">
                                            <span class="blog-slider__code d-none d-md-block ">در مهر ماه سال ۱۴۰۰</span>
                                            <div class="blog-slider__title">راه‌اندازی پورتال انتشارات دانشگاه صنعتی </div>
                                            <div class="blog-slider__text d-none d-md-block">درخشش دانشجوی رشته مهندسی کامپیوتر دانشکده فناوری اطلاعات و مهندسی کامپیوتر دانشگاه شهید مدنی آذربایجان نوزدهمین مسابقات ملی مهارت</div>
                                            <a href="#" class="blog-slider__button">اطلاعات بیشتر</a>
                                        </div>
                                        <div class="blog-slider__img d-none d-md-block">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-slider__item swiper-slide">
                                        <div class="blog-slider__img d-none">

                                            <img src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759872/kuldar-kalvik-799168-unsplash.webp" alt="">
                                        </div>
                                        <div class="blog-slider__content">
                                            <span class="blog-slider__code d-none d-md-block ">در مهر ماه سال ۱۳۹۹</span>
                                            <div class="blog-slider__title">راه‌اندازی پورتال </div>
                                            <div class="blog-slider__text d-none d-md-block">درخشش دانشجوی رشته مهندسی کامپیوتر دانشکده فناوری اطلاعات و مهندسی کامپیوتر دانشگاه شهید مدنی آذربایجان نوزدهمین مسابقات ملی مهارت</div>
                                            <a href="#" class="blog-slider__button">اطلاعات بیشتر</a>
                                        </div>
                                        <div class="blog-slider__img d-none d-md-block">

                                            <img src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-slider__pagination"></div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row" style="direction: rtl">
                    <div class="col-md-2 d-none d-md-block" style="background: linear-gradient(to right, #313a4e, #45a5ff) !important">
                        <div class="d-flex flex-column-reverse justify-content-center align-items-center h-100 w-100">
                            <h6 class="text-center text-white" style="margin-top: 5px;font-weight: 500"><i class="feather icon-message-square"></i> آخرین اخبار: </h6>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-12" style="background: rgb(49, 58, 78) none repeat scroll 0% 0% / cover" >
                        <div id="carouselContent" class="carousel slide" data-ride="carousel" style="height: 40px;padding-top: 10px">
                            <div class="carousel-inner" role="listbox" style="">
                                <div class="carousel-item   text-center text-white active ">
                                    <a href="" class="text-white" target="_blank">راه‌اندازی فروشگاه انتشارات دانشگاه شریف</a>
                                </div>
                                <div class="carousel-item text-center text-white ">
                                    <a href="" class="text-white"  target="_blank">اطلاعیه مهم درباره سفارشات بازه ۱۴۰۱/۱۲/۲۹</a>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselContent" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselContent" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>


                <!-- section begin -->
                <section id="subheader" class="py-md-2" data-bgimage="url(images/background/5.png) bottom" style="min-height: calc(13vh)">
                    <div class="row">
                        <div class="col-md-10 col-sm-12 m-auto">
                            <form action="">
                                <div class="wrapSearch my-md-4">
                                    <div class="search">
                                        <input type="text" class="searchTerm" placeholder="عنوان کتاب یا نام نویسنده را وارد نمایید">
                                        <button type="submit" class="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <section id="component-swiper-centered-slides">
                    <div class="card bg-transparent shadow-none" style="border:none ">
                        <div class="card-header  text-right d-flex align-items-center justify-content-between w-100" style="border-bottom: none">
                            <a href="{{url('/books/index')}}" class="">
                                <h4 class="card-title see-all">  مشاهده همه <i class="feather icon-arrow-left-circle"></i></h4>
                            </a>
                            <h5 class="see-sections" style="font-size: 22px" id="categories">  دسته‌بندی‌ها <span style="font-size: 10px">(تعداد)</span> <i class="feather icon-list"></i></h5>
                        </div>
                        <div class="card-content" style="background-color: rgba(0,0,0,.03);">
                            <div class="card-body pt-0">
                                <div class="swiper-multiple swiper-container" style="direction: rtl">
                                    <div class="swiper-wrapper py-2">
                                        @foreach($categories as $category)
                                            <a href="" class="swiper-slide rounded swiper-shadow d-flex @if(\Illuminate\Support\Facades\Request::path() == 'category/'.$category->id.'/books') active @endif" >
                                                @if(\Illuminate\Support\Facades\Request::path() == 'category/'.$category->id.'/books')
                                                    <i class="feather icon-arrow-left-circle " style="margin-left: 3px;margin-top: 6px"></i>
                                                @endif
                                                <div class="swiper-text">{{$category->title}} - {{$category->books->count()}}</div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    {{--                            <div class="swiper-pagination"></div>--}}
                                </div>
                            </div>
                            <div class="container mb-2">
                                <div class="card mx-2">
                                    <div class="card-content">
                                        <div class="card-body  w-100 row">
                                            @foreach($books as $book)

                                                <div class="ProductWrapper  col-md-3 col-sm-12 m-sm-auto" title="{{$book->title}}">
                                                    <div class="body">
                                                        <div class="product-image-wrapper">
                                                            <a href="{{route('book.details',$book->id)}}" target="_blank">
                                                         <span class="book-wrap" title="{{$book->title}}">
                                                                <img class=" book-hover"  src="{{asset($book->image)}}"  alt="{{$book->title}}">
                                                         </span>
                                                            </a>
                                                            <img src="" style="position: absolute;left: 0px;top:0px;max-width: 55px;height: auto" alt="">
                                                            <div class="video-card-gradient-overlay" >
                                                                <div class="d-flex w-100 align-items-center justify-content-center">
                                                                    <p class="text-white " title="{{$book->title}}" style="font-size: 14px" onclick="addToBag('{{$book->title}}','@foreach ($book->authors as $author)
                                                                    {{$author->title}} -
                                                                    @endforeach','{{asset($book->image)}}','{{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}}','{{$book->id}}')"> <span id="addOverlayText{{$book->id}}">افزودن به سبد خرید</span> <i class="feather icon-shopping-bag"></i></p>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <a href="{{route('book.details',$book->id)}}" target="_blank">
                                                            <div class="text">
                                                                کتاب {{$book->title}} اثر

                                                                @foreach ($book->authors as $author)
                                                                    {{$author->title}} -
                                                                @endforeach
                                                                انتشارات نگین ایران
                                                            </div>
                                                            @if($book->discount_percent > 0)
                                                                <div class="price" >
                                                                    <span class="offed-price"> {{number_format($book->price)}}  </span>
                                                                    <span  class="off-percent"> {{$book->discount_percent}}%</span>
                                                                    <div class="price">
                                                                        {{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}} تومان
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="price">
                                                                    {{number_format($book->price)}} تومان
                                                                </div>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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






<script  src="{{asset('site-js/swiper.min.js')}}"></script>
<script src="{{asset('site-js/swiper2.min.js')}}"></script>

<script src="{{asset('site-js/swiper3.js')}}"></script>
<script>

    $(window).load(function() {

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
<script>
    $(window).load(function() {

    });

    $("#comment-btn").click(function() {
        // console.log($("#customers").offset().top)
        $('html, body').animate({
            scrollTop: $("#comments").offset().top - 140
        }, 1333);
    });
    $("#about").click(function() {
        // console.log($("#customers").offset().top)
        $('html, body').animate({
            scrollTop: $("#about-book").offset().top - 140
        }, 1333);
    });
</script>
<script>
    var swiper = new Swiper('.blog-slider', {
        spaceBetween: 30,
        effect: 'fade',
        loop: true,
        autoplay:true,
        autoplay: {
            delay: 3500,
        },
        // mousewheel: {
        //     invert: false,
        // },
        // autoHeight: true,
        pagination: {
            el: '.blog-slider__pagination',
            clickable: true,
        }
    });
    $('#category').select2()


    $("#customers-btn").click(function() {
        console.log($("#customers").offset().top)
        $('html, body').animate({
            scrollTop: $("#customers").offset().top - 130
        }, 1333);
    });
    $("#product-btn").click(function() {
        console.log($("#products").offset().top)
        $('html, body').animate({
            scrollTop: $("#products").offset().top - 110
        }, 1333);
    });
</script>

</html>
