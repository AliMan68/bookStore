<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title."-انتشارات دانشگاه" ?? 'انتشارات دانشگاه' }}</title>

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
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/owl.carousel.css')}}"  >
    <!-- color scheme -->
    <link id="colors" href="{{asset('site-css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" type="text/css" href="{{asset('site-css/coloring.css')}}" />
    @yield('style')
</head>

<body>
<div id="wrapper" class="horizontal-layout horizontal-menu content-detached-left-sidebar ecommerce-application navbar-floating footer-static " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" style="min-height: 900px;background: rgba(0, 0, 0, 0) linear-gradient(155deg, rgba(8, 46, 198, 0.15) 4%, rgba(200, 150, 0, 0.18) 96%) repeat scroll 0% 0% / cover;">
    @include('site.layout.navbar')
    <livewire:card-modal/>

    {{$slot}}
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
    @include('site.layout.footer')


</body>
{{--<script>--}}
{{--    $(window).load(function() {--}}
{{--    --}}
{{--        $('#navigation-menu').addClass("smaller")--}}
{{--    });--}}
{{--</script>--}}


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

<script src="{{asset('site-js/owl.carousel.js')}}"></script>




<script  src="{{asset('site-js/swiper.min.js')}}"></script>
<script src="{{asset('site-js/swiper2.min.js')}}"></script>

<script src="{{asset('site-js/swiper3.js')}}"></script>
{{--<script>--}}

{{--    $(window).load(function() {--}}

{{--    });--}}
{{--    $('#category').select2()--}}
{{--    $('#bookSection').select2()--}}
{{--    $('#bookTranslator').select2()--}}
{{--    $('#bookWriter').select2()--}}
{{--    function toggleFilters() {--}}
{{--        $('#filter-column').toggleClass('d-none')--}}
{{--    }--}}
{{--</script>--}}

{{--<script>--}}
{{--    (function ($) {--}}
{{--        $(document).ready(function () {--}}
{{--            $(function() {--}}
{{--                $('.date-picker').persianDatepicker({--}}
{{--                    formatDate: "YYYY/0M/0D"--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    })--}}



{{--</script>--}}





</html>
