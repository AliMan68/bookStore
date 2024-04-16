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
    <div class=" mt-5" style="font-weight: 900;font-size: 1.9rem;color:rgba(201,90,16,0.83) ">سامانه ساجد دانشگاه {{\App\Models\Setting::get(\App\Models\Setting::KEY_UNIVERSITY_NAME)->value}}</div>
    <div class=" mt-0"><img src="{{asset('fail.png')}}" alt="پرداخت ناموفق" style="width: 190px"></div>

    <div class="my-2">پرداخت ناموفق</div>
    <a href="{{route('home')}}" class="text-center text-white mt-3 p-2" style="text-decoration: none;width: 290px ; border-radius: 4px;alignment: center;font-family: Vazir;font-weight: 500;font-size: 15px; background-color: #fa6d39; border-color: antiquewhite" > پنل کاربری </a>

    <div class=" mt-5 text-center" style="color: lightgrey;font-weight: 400;font-size: 18px;color:gray; padding: 0px 15px ">{{$description}}</div>

</div>
</body>

</html>
