<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8" />
    <title>سبد خرید | انتشارات دانشگاه صنعتی شریف</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="انتشارات دانشگاه صنعتی شریف"  />
    <meta  name="keywords" content="سبد خرید"/>
    <meta  name="author" content="پرشین داده - persiandade.ir"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
</head>
<body class="">
<h6 class="text-white mt-1 messageStyle" id="successMessage">
</h6>
<h6 class="text-white mt-1 messageStyleError" id="errorMessage">
</h6>


<div id="wrapper" class="" style="min-height:900px;background: rgba(0, 0, 0, 0) linear-gradient(155deg, rgba(8, 46, 198, 0.15) 4%, rgba(200, 150, 0, 0.18) 96%) repeat scroll 0% 0% / cover;padding-bottom: 100px !important;}">
@include('site.layouts.navbar')
<!-- content begin -->

    @if(count($cart) > 0 )

        <div class="container-fluid" id="checkout-container" style="margin-top:4rem;height: auto;min-height: 260px;direction: rtl;">
            <div class="row" style="position: relative">

                <div class="col-md-8 col-sm-12 m-auto">
                    <form action="{{route('payment.create')}}" method="post" id="msform">
                    @csrf

                    <!-- progressbar -->
                        <ul id="progressbar" style="direction: rtl;">
                            <li class="active"><i class="feather icon-clock"></i> بررسی سبد خرید</li>
                            <li><i class="feather icon-map-pin"></i> درج آدرس</li>
                            <li><i class="feather icon-credit-card"></i> تایید و پرداخت</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>

                            <h2 class="fs-title text-right">جزییات سبد خرید :</h2>
                            <div class="d-flex align-items-center justify-content-between w-100">
                                @if(\Illuminate\Support\Facades\Session::get('fail'))
                                    <h6 class="ml-auto alert alert-danger mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>
                                @endif
                                @if(\Illuminate\Support\Facades\Session::get('success'))
                                    <h6 class="ml-auto alert alert-success mt-1" style="font-weight: normal;"> {{\Illuminate\Support\Facades\Session::get('success')}}</h6>
                                @endif
                            </div>
                            <div style="max-height: 550px;overflow-x: hidden;overflow-y: scroll">
                                @php
                                    $totalPrice = 0;

                                @endphp
                                @foreach($cart as $product)
                                    @if(isset($product['book']))
                                        {{--                                    @if($product['book']->count > 0)--}}
                                        @php
                                            $book = $product['book'];
                                            $quantity = $product['quantity'];
                                            $totalPrice = $totalPrice + ($book->price - ($book->price * $book->discount_percent/100)) * $quantity;
                                        @endphp
                                        <div class="card" style="border: none">
                                            <div class="card-content row" style="direction: rtl">
                                                <div class="col-md-2 col-sm-12 d-flex align-items-center justify-content-start" id="justify-center">
                                                    <div class="" style="max-width: 130px;max-height: 170px" >
                                                        <img class="" style="height: auto;width: auto;max-height: 171px;max-width: 141px"  src="{{asset($book->image)}}"  alt="عناون کتاب قرار می‌گیرد">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-start"  id="justify-center">
                                                    <div class="d-flex flex-column w-100 align-items-start h-100 justify-content-start">
                                                        <a href="{{url('/book-details')}}" target="_blank">
                                                            <p class="text-right text-dark mb-1" style="font-size: 18px;line-height: 1.7">{{$book->title}}</p>
                                                        </a>

                                                        <p class="text-right text-muted mb-1" style="font-size: 14px;line-height: 1.7">نویسنده :
                                                            @foreach ($book->authors as $author)
                                                                {{$author->title}} -
                                                            @endforeach
                                                        </p>
                                                        @if($book->count > 0)
                                                            <p class="text-right text-muted mb-1" style="font-size: 13px;line-height: 1.7">وضعیت : <span style="color: darkgreen"> <i class="feather icon-check-circle" ></i> موجود </span>  </p>
                                                            <p class="text-right text-muted mb-1" style="font-size: 14px;line-height: 1.7"> تعداد :</p>
                                                            <div style="position:relative;">
                                                                <button id="" class="minus" type="button"  style="border-radius: 3px;background: rgb(12, 40, 100);border:none;color: white;width: 30px;height: 30px"  onclick="changeQuantity('{{$product['id']}}','minus')" ><i class="feather icon-minus" style="font-size: 0.85rem;font-weight: 500"></i></button>
                                                                <input id="bookCount{{$product['id']}}" class="px-1 quantity3" disabled style="max-width: 50px !important;max-height: 42px;border: none;text-align: center;border-radius: 5px;background: rgba(187,187,183,0.16)" value="{{$quantity}}">
                                                                <button id="" class="plus" type="button" style="width: 30px ;border-radius: 3px;background: rgb(12, 40, 100);border:none;color: white;width: 30px;height: 30px" onclick="changeQuantity('{{$product['id']}}','add')" ><i class="feather icon-plus" style="font-size:0.85rem;font-weight: 500"></i></button>
                                                            </div>
                                                        @else
                                                            <p class="text-right text-muted mb-1" style="font-size: 13px;line-height: 1.7">وضعیت : <span style="color: darkred"> <i class="feather icon-slash" ></i> ناموجود </span>  </p>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 align-items-center justify-content-start" style="border-right: 1px rgba(128,128,128,0.85) dotted"  id="justify-center">
                                                    <div class="d-flex flex-column w-100 align-items-start h-100 justify-content-around" id="flex-row">
                                                        <h4 style="font-size: 15px">
                                                            @if($book->discount_percent>0)
                                                                <p class="text-muted d-none d-md-block" style="text-decoration: line-through;font-size: 12px">
                                                                    {{number_format($book->price)}} تومان
                                                                </p>
                                                            @endif
                                                            قیمت واحد :  {{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}} تومان
                                                        </h4>
                                                        <a data-toggle="modal" data-target="#removeBook{{$product['id']}}" style="color: darkred;border: #8b00004f 1px solid;padding: 1px 10px;border-radius: 3px;cursor: pointer"><i class="feather icon-trash"></i>
                                                            حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                    @endif--}}
                                        <hr class="my-1 {{$loop->last ? 'd-none':''}}" >
                                    @endif
                                @endforeach
                            </div>
                            <hr class="my-1" id="nextSub">
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">آدرس </h2>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-name">*نام کامل تحویل گیرنده :</label>
                                        <input type="text" id="checkout-name" class="form-control required" name="receiver_name" value="{{old('receiver_name')}}" placeholder="نام کامل-اجباری" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-number">*شماره موبایل :</label>
                                        <input type="number" id="checkout-number" class="form-control required" name="receiver_number"  value="{{old('receiver_number')}}" placeholder="شماره موبایل-اجباری" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-apt-number"> تحویل حضوری(در دانشگاه) : </label>
                                        <ul class="list-unstyled mt-1">
                                            <li class="d-inline-block mr-2">

                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input " name="delivery_type"  id="customRadio1" value="in_person">
                                                    <label class="custom-control-label" for="customRadio1">بله</label>
                                                </div>

                                            </li>
                                            <li class="d-inline-block mr-2">

                                                <div class="custom-control custom-radio ">
                                                    <input type="radio" class="custom-control-input vs-radio-cyan" checked name="delivery_type" id="customRadio2"  value="in_post">
                                                    <label class="custom-control-label" for="customRadio2">خیر</label>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-postal-code">کد پستی : </label>
                                        <input type="number" id="checkout-postal-code" class="form-control " name="receiver_postal_code"  value="{{old('receiver_postal_code')}}"  placeholder="کد پستی" >
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-state">*استان :</label>
                                        <input type="text" id="checkout-state" class="form-control required" name="receiver_state"  value="{{old('receiver_state')}}" placeholder="استان" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-city">*شهر :</label>
                                        <input type="text" id="checkout-city" class="form-control required" name="receiver_city"  value="{{old('receiver_city')}}"  placeholder="شهر" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-address">*آدرس :</label>
                                        <textarea type="text" id="checkout-address" rows="2" class="form-control required" name="receiver_address"  placeholder="آدرس را وارد نمایید" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="alert alert-info">
                                        در صورت انتخاب تحویل حضوری با به همراه داشتن کد سفارش به انتشارات مراجعه نمایید
                                    </p>
                                </div>
                            </div>
                            <hr class="my-1" id="nextSub2">
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">تایید و پرداخت</h2>
                            <div class="row">
{{--                                <div class="col-md-4 col-sm-12 d-flex align-items-center justify-content-start mt-1"  id="justify-center">--}}
{{--                                    <p class="text-right text-muted mb-1" style="font-size: 14px;line-height: 1.7">مبلغ کل سفارش :  <span id="totalPrice3">{{number_format($totalPrice)}}</span> تومان </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 col-sm-12 d-flex align-items-center justify-content-start mt-1"  id="justify-center">--}}
{{--                                    <p class="text-right text-muted mb-1" style="font-size: 14px;line-height: 1.7"> مالیات : 0 تومان</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3 col-sm-12 d-flex align-items-center justify-content-start mt-1"  id="justify-center">--}}
{{--                                    <p class="text-right text-muted mb-1" style="font-size: 14px;line-height: 1.7">هزینه ارسال : 0 تومان</p>--}}
{{--                                </div>--}}
                                <div class="col-sm-12 d-flex align-items-center justify-content-center mt-1"  id="justify-center">
{{--                                    <button type="submit" class="btn btn-warning d-block " id=""  style="min-width: 199px" name="" onclick="$('#msform').submit()"> <i class="feather icon-check-circle" ></i> پرداخت </button>--}}
                                    <div class="d-flex flex-row align-items-center justify-content-start w-100">
                                        <div class="input-group input-group-sm m-1 my-2 " style="width: 350px;border: 1px solid #bd8f03;border-radius: 6px;">
                                                    <input type="text" name="discount-code" id="discount-code" value="" class="form-control float-right " style="border: none;font-size: 11px;width: auto;margin-top: 10px;" placeholder="ثبت کد تخفیف">
                                                    <input type="hidden" name="discount_code_value" id="discount-code-value" value="">

                                                    <div class="input-group-append">
                                                        <div   class="btn btn-default" id="discount-code-button" onclick="submitDiscountCode()" style="color: #bd8f03;margin-top: 10px;"><i class="feather icon-check-circle"></i>ثبت کد </div>
                                                        <div  class="btn btn-default d-none" id="discount-code-message" style="color: #bd8f03;margin-top: 10px;font-size: 12px"><i class="feather icon-check-circle"></i>کد تخفیف با موفقیت اعمال شد</div>
                                                    </div>
                                                </div>
                                    </div>
                                </div>

                            </div>
                            <p class="text-dark mt-4 text-right" style="font-size: 0.88rem">- پس از پرداخت،می‌توانید سفارش خود را در <strong> پنل کاربری و در بخش سفارشات من </strong> مشاهده فرمایید.</p>
                            <p class="text-dark mt-1 text-right" style="font-size: 0.88rem">- در صورت انتخاب <strong> تحویل حضوری </strong> جهت دریافت سفارش خود به انتشارات مراجعه فرمایید.</p>
                            {{--                        <input type="button" name="previous"  class="previous action-button-previous" value="مرحله قبل"/>--}}
                            <hr class="my-1" id="nextSub3">
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-4 mx-auto" style="position: relative;">
                    <div class="card prices-card" style="position:-webkit-sticky;position:sticky;top:1px">
                        <div class="d-flex flex-column w-100">
                            <div class="d-flex align-items-center justify-content-between px-2 py-1 mx-2">
                                <p class="text-muted text-right" style="font-size: 13px">
                                    مجموع قیمت :
                                </p>
                                <p class="text-dark" style="font-size: 14px;text-align: right" id="">
                                    <span id="totalPrice4">{{number_format($totalPrice)}}</span>   تومان
                                </p>

                            </div>
                            <div class="d-flex align-items-center justify-content-between px-2 py-1 mx-2" style="border-top: 1px solid rgba(191, 191, 191, 0.38) ">
                                <p class="text-muted text-right"  style="font-size: 13px">
                                    ارزش افزوده :
                                </p>
                                <p class="text-dark" style="font-size: 14px;text-align: right">
                                    0 تومان
                                </p>

                            </div>
                            <div class="d-flex align-items-center justify-content-between px-2  py-1 mx-2" style="border-top: 1px solid rgba(191, 191, 191, 0.38) ">
                                <p class="text-muted text-right"  style="font-size: 13px">
                                    هزینه ارسال :
                                </p>
                                <p class="text-dark" style="font-size: 14px;text-align: right">
                                    0 تومان
                                </p>

                            </div>
                            <div class="d-flex align-items-center justify-content-between px-2  py-1 mx-2" style="border-top: 1px solid rgba(191, 191, 191, 0.98) ">
                                <p class=" text-right"  style="font-size: 15px;color: #000d4f;letter-spacing: 1px;font-weight: 600">
                                    قابل پرداخت :
                                </p>
                                <p class="" style="font-size: 17px;text-align: right;color: #000d4f">
                                    <span id="totalPrice">{{number_format($totalPrice)}}</span> تومان
                                </p>

                            </div>
                            <div class="d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-between px-2  py-1 mx-2 mt-2">
                                    <button type="button" class="btn btn-warning d-none" id="payBtn"  style="min-width: 140px" name="" onclick="$('#msform').submit()"> <i class="feather icon-check-circle" ></i> پرداخت </button>
                                    <button type="button" class="btn btn-warning next" id="nextBtn"  style="max-width: 116px" name="next"> <i class="feather icon-arrow-left-circle" ></i> مرحله بعد </button>
                                    <button type="button" id="previous" class="btn previous d-none" style="max-width: 120px ;font-size: 12px;color: darkcyan;border: none;text-decoration: underline" name="previous">  بازگشت </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-price-card d-md-none d-block" >
            <div class="w-100 bg-white" style="padding: 5px 20px">
                <div class="d-flex flex-row w-100 align-items-center justify-content-between">
                    <div class="d-flex " id="flex-column">
                        <button type="button" class="btn btn-warning next" id="nextBtn2"  style="max-width: 100px;font-size: 13px;padding: 12px" name="next"> <i class="feather icon-arrow-left-circle" ></i> مرحله بعد </button>
                        <button type="button" class="btn btn-warning d-none" id="payBtn2"  style="min-width: 140px" name=""> <i class="feather icon-check-circle" ></i> پرداخت </button>
                        <button type="button" id="previous2" class="btn previous d-none" style="max-width: 120px ;font-size: 12px;color: darkcyan;border: none;text-decoration: underline" name="previous">  بازگشت </button>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="text-dark">قابل پرداخت :</p>
                        <p class="text-dark">
                            <span  id="totalPrice2">{{number_format($totalPrice)}}</span> تومان
                        </p>
                    </div>

                </div>
            </div>

        </div>

    @else
        <div class="container-fluid" id="checkout-container" style="margin-top:8rem;height: auto;min-height: 260px;direction: rtl;">
            <div class="row" style="position: relative">
                <div class="col-md-8 col-sm-12 m-auto mt-5">
                    <div class="card">
            <div class="card-body">
                <h3 class="text-center alert alert-info p-4">
                    <i class="feather icon-shopping-bag"></i>
                    سبد خرید شما خالی است!
                </h3>

                <div class="d-flex align-items-center justify-content-center">
                    <h5 class="mt-1">رفتن به :</h5>
                    <a href="{{route('index')}}" class="mx-3">  صفحه نخست |</a>
                    <a href="{{route('books.index')}}" > لیست کتاب‌ها </a>

                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    @endif


</div>
@foreach($cart as $product)
    <div class="modal fade " id="removeBook{{$product['id']}}" tabindex="-1" role="dialog" aria-labelledby="removeBook{{$product['book']}}" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-scrollable"  role="document">
            <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                <div class="modal-header d-flex flex-row w-100 align-items-center justify-content-between">
                    <h5 class="modal-title text-right" id=""><i class="feather icon-trash " style="font-size: 20px"></i> حذف کتاب {{$product['book']->title}} از سبد خرید</h5>
                    <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form w-100 my-1 mx-2 mb-0" action="{{route('cart.delete',$product['id'])}}" method="post">
                    <div class="modal-body row" id="">

                        @csrf
                        @method('delete')
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <h5 class="text-center m-auto">آیا اطمینان دارید؟</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-12 d-flex flex-eow align-items-center justify-content-between w-100">
                            <button type="submit" class="btn btn-danger" id="">
                                <i class="feather icon-trash"></i> حذف
                            </button>
                            <button class="btn btn-outline-dark" data-dismiss="modal" aria-label="Close">انصراف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
</body>

{{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>--}}
{{--<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>--}}
{{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script><script  src="./script.js"></script>--}}

{{--<!-- Javascript Files--}}
{{--================================================== -->--}}
{{--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>--}}
{{--<script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>--}}



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

<script>
    $(window).load(function() {
        $('#navigation-menu').addClass("smaller")
    });
    function addProduct(id){
        $('#messageNavigation').addClass("left-zero");
        setTimeout(function () {
            $('#messageNavigation').removeClass("left-zero",1000, "easeInOutQuad");
        },3500);
    }

    $('input[type=radio][name=delivery_type]').change(function() {
        if (this.value == 'in_person') {
            $('#checkout-postal-code').prop( "disabled", true );
            $('#checkout-state').prop( "disabled", true );
            $('#checkout-city').prop( "disabled", true );
            $('#checkout-address').prop( "disabled", true );
        }
        else if (this.value == 'in_post') {
            $('#checkout-postal-code').prop( "disabled", false );
            $('#checkout-state').prop( "disabled", false );
            $('#checkout-city').prop( "disabled", false );
            $('#checkout-address').prop( "disabled", false );
        }
    });

    var counter = 0


    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function(){
        if(animating) return false;
        animating = true;

        counter = counter + 1

        if(counter > 0 ){
            $('#previous').removeClass('d-none')
            $('#previous2').removeClass('d-none')
        }
        if(counter == 2 ){
            $('#nextBtn').addClass('d-none')
            $('#payBtn').removeClass('d-none')

            $('#nextBtn2').addClass('d-none')
            $('#payBtn2').removeClass('d-none')
        }


        switch (counter) {
            case 1 :
                current_fs = $('#nextSub').parent();
                next_fs = $('#nextSub').parent().next();
                break;
            case 2 :
                current_fs = $('#nextSub2').parent();
                next_fs = $('#nextSub2').parent().next();

                break;
            case 3 :

                break;
        }


        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale('+scale+')',
                    'position': 'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function(){
        console.log('Previous Clicked!')
        if(animating) return false;
        animating = true;

        switch (counter) {
            case 1 :
                current_fs = $('#nextSub2').parent();
                previous_fs = $('#nextSub2').parent().prev();
                break;
            case 2 :
                current_fs = $('#nextSub3').parent();
                previous_fs = $('#nextSub3').parent().prev();

                break;
            case 3 :

                break;
        }
        counter = counter - 1
        if(counter != 2 ){
            $('#payBtn').addClass('d-none')
            $('#nextBtn').removeClass('d-none')

            $('#payBtn2').addClass('d-none')
            $('#nextBtn2').removeClass('d-none')

        }

        if(counter == 0){
            $('#previous').addClass('d-none')
            $('#previous2').addClass('d-none')
        }
        // current_fs = $(this).parent();
        // previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                previous_fs.css({'position' : 'relative'});
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function(){
        return false;
    })
</script>

<script>
    function submitDiscountCode(code) {

        var code = $('#discount-code').val()

        var totalPrice = parseInt(numberWithoutCommas($('#totalPrice4').text()))
        console.log(totalPrice)
        {{--var totalPrice = {{$totalPrice}}--}}
        setTimeout(function () {
            $('#successMessage').removeClass("left-zero",1000, "easeInOutQuad");
            $('#errorMessage').removeClass("left-zero",1000, "easeInOutQuad");
        },3500);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                'Content-Type' : 'application/json'
            }
        })
        $.ajax({
                type : 'POST',
                url : '/discount-code/submit',
                data : JSON.stringify({
                    code : code ,
                }),
                success : function(response) {
                    // location.reload();
                    if(response.status == 'success'){
                        $('#successMessage').text(response.message)
                        // console.log(response.percent)
                        // console.log(totalPrice)
                        // console.log((totalPrice * response.percent / 100))
                        $('#totalPrice').text(numberWithCommas(parseInt(totalPrice - (totalPrice * response.percent / 100))))
                        $('#totalPrice2').text(numberWithCommas(parseInt(totalPrice - (totalPrice * response.percent / 100))))
                        $('#totalPrice3').text(numberWithCommas(parseInt(totalPrice - (totalPrice * response.percent / 100))))
                        $('#totalPrice4').text(numberWithCommas(parseInt(totalPrice - (totalPrice * response.percent / 100))))
                        $('#successMessage').addClass('left-zero')
                        setTimeout(function () {
                            $('#successMessage').removeClass("left-zero",1000, "easeInOutQuad");
                        },9900);
                        $('#discount-code').attr('disabled', 'disabled')
                        $('#discount-code-value').val(response.code)
                        $('#discount-code-button').addClass('d-none')
                        $('#discount-code-message').removeClass('d-none')
                    }else{
                        $('#errorMessage').text(response.message)
                        $('#errorMessage').addClass('left-zero')
                        setTimeout(function () {
                            $('#errorMessage').removeClass("left-zero",1000);
                        },9900);
                    }
                },
                fail : function(response) {
                    // location.reload();
                }
            });

    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function numberWithoutCommas(x) {
        return x.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "")
    }
    function changeQuantity(id,type){
        setTimeout(function () {
            $('#successMessage').removeClass("left-zero",1000, "easeInOutQuad");
            $('#errorMessage').removeClass("left-zero",1000, "easeInOutQuad");
        },3500);

        var currentProductCount = $('#bookCount'+id)
        var requestedCount = 1;

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                'Content-Type' : 'application/json'
            }
        })
        if (currentProductCount.val() == 1 && type == 'minus'){
            alert('حداقل سفارش (یک عدد) می‌باشد ')
            return
        }else{
            $.ajax({
                type : 'POST',
                url : '/cart/quantity/change',
                data : JSON.stringify({
                    id : id ,
                    quantity : requestedCount,
                    type : type,
                }),
                success : function(response) {
                    // location.reload();
                    console.log(response.status)
                    if(response.status == 'success'){
                        $('#successMessage').text(response.message)
                        $('#totalPrice').text(response.total_price)
                        $('#totalPrice2').text(response.total_price)
                        $('#totalPrice3').text(response.total_price)
                        $('#totalPrice4').text(response.total_price)
                        $('#successMessage').addClass('left-zero')
                        $('#bookCount'+id).val(response.quantity)
                        setTimeout(function () {
                            $('#successMessage').removeClass("left-zero",1000, "easeInOutQuad");
                        },9900);
                        //return discount code to first state
                        $('#discount-code').prop('disabled', false);
                        $('#discount-code-button').removeClass('d-none')
                        $('#discount-code-message').addClass('d-none')
                    }else{
                        $('#errorMessage').text(response.message)
                        $('#errorMessage').addClass('left-zero')
                        setTimeout(function () {
                            $('#errorMessage').removeClass("left-zero",1000);
                        },9900);
                    }
                },
                fail : function(response) {
                    // location.reload();
                }
            });
        }
    }
</script>
</html>
