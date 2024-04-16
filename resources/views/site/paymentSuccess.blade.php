<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="enamad" content="265375"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    @include('include.template-css')
    @include('include.template-js')
</head>
<body>
<div class="d-flex flex-column justify-content-center align-items-center">
    <div class=" mt-5" style="font-weight: 900;font-size: 1.9rem;color:rgba(16,136,201,0.83) ">سامانه ساجد دانشگاه {{\App\Models\Setting::get(\App\Models\Setting::KEY_UNIVERSITY_NAME)->value}}</div>
    <div class=" mt-0"><img src="{{asset('successfull.png')}}" alt="پرداخت موفق" style="width: 190px"></div>

    <div class="my-2">{{$description}}</div>
    <div class="">مبلغ پرداخت شده : {{number_format($amount)}} ریال</div>
    <div class="">شماره مرجع تراکنش : {{$retrival_ref_no}}</div>
    <div class="">شماره پیگیری : {{$system_trace_no}}</div>
    <a href="{{route('home')}}" class="text-center text-white mt-3 p-2" style="text-decoration: none;width: 290px ; border-radius: 4px;alignment: center;font-family: Vazir;font-weight: 500;font-size: 15px; background-color: rgba(15,135,199,0.83); border-color: antiquewhite" > پنل کاربری </a>

</div>
</body>

</html>
