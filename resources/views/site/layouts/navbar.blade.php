<header class="transparent scroll-light" style="" id="navigation-menu">
    <div class="container px-0 h-100" style="max-width: 95%">
        <div class="row h-100">
            <div class="col-md-12 h-100">
                <div id="set-padding" class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-none d-md-block">
                        <div class="" style="min-width: 180px">

                            @auth
                                @if(auth()->user()->is_admin != 1 )
                                    @if(auth()->user()->roles()->get()->first()->title == 'کاربر' )
                                        <a href="{{route('admin.user.orders')}}">
                                            <button class="btn btn-info nav-login-btn" style="font-weight: 500;font-size: 0.88rem;!important;">
                                                پنل کابری
                                                <i class="feather icon-user" style=""></i>
                                            </button>
                                        </a>

                                        {{--                                        @if(auth()->user()->roles()->get()->first()->title == 'کارشناس' )--}}
                                        {{--                                            <a href="{{route('admin.user.orders')}}">--}}
                                        {{--                                                <button class="btn btn-info nav-login-btn" style="font-weight: 500;font-size: 0.88rem;!important;">--}}
                                        {{--                                                    پنل کابری--}}
                                        {{--                                                    <i class="feather icon-user" style=""></i>--}}
                                        {{--                                                </button>--}}
                                        {{--                                            </a>--}}
                                        {{--                                    @endif--}}

                                    @else

                                        <a href="{{url('admin/orders?type=completed&search=')}}">
                                            <button class="btn btn-info nav-login-btn" style="font-weight: 500;font-size: 0.88rem;!important;">
                                                پنل کابری
                                                <i class="feather icon-user" style=""></i>
                                            </button>
                                        </a>
                                    @endif
                                @endif
                            @endauth
                            @guest
                                    <a href="{{route('auth.login')}}">
                                        <button class="btn btn-info nav-login-btn" style="font-weight: 500;font-size: 0.88rem;!important;">
                                            ورود یا ثبت ‌نام
                                            <i class="feather icon-user" style=""></i>
                                        </button>
                                    </a>
                            @endguest


                        </div>
                    </div>
                    <div class="d-none d-md-block ">
                        <i class="feather icon-search nav-search-icon" data-toggle="modal" data-target="#searchModal" style=""></i>
                    </div>
                    <div class="ml-md-4 d-none d-md-block">
                        <div class="" style="position: relative"  data-toggle="modal" data-target="#bagModal" id="bagIcon">
                            <i class="feather icon-shopping-bag nav-search-icon"  style=""></i>
                            <div class="badge badge-pill badge-danger badge-up"  style="position: absolute;bottom: -12px;right:1px;padding: 0.4rem;border-radius: 5px;font-weight: 500;min-width: 22px;height: 20px"> <span id="bagCount">{{count(\App\Helpers\Cart\Cart::all())}}</span></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-start w-100">
                        <div class="align-self-center ml-auto header-col-mid" style="">
                            <!-- mainmenu begin -->
                            <ul id="mainmenu" style="">

                                <li>
                                    <a href="{{url('/')}}"><i class="feather icon-home"></i> صفحه اصلی</a>
                                </li>
                                <li id="submenu">
                                    <a href="{{route('books.index')}}" id=""><i class="feather icon-list"></i> کتاب‌ها</a>
                                    <ul>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <li><a href="{{url('/books/index?categories[]='.$category->id)}}"  style="text-align: right" >{{$category->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{url('/news')}}" id="customers-btn"><i class="feather icon-message-square"></i> اخبار و اطلاعیه‌ها</a>
                                </li>
                                <li>
                                    <a href="#" id="customers-btn"><i class="feather icon-move"></i> راهنما</a>
                                </li>
                                {{--                                <li>--}}
                                {{--                                    <a href="{{url('/contact-us')}}"><i class="feather icon-phone-call"></i> تماس با ما</a>--}}
                                {{--                                </li>--}}
                                <li class="d-md-none ">
                                    <a href="{{route('cart.checkoutList')}}"><i class="feather icon-shopping-bag"></i> سبد خرید <div class="badge badge-pill badge-danger badge-up"  style="position: absolute;bottom: 11px;left:10px;padding: 0.4rem;border-radius: 5px;font-weight: 500;min-width: 22px;height: 20px"> <div id="bagCount2">{{count(\App\Helpers\Cart\Cart::all())}}</div></div></a>
                                </li>

                                <li class="d-md-none ">
                                    <a href="{{route('auth.login')}}"><i class="feather icon-user"></i>ورود یا ثبت‌نام </a>
                                </li>
                                <li class="d-block d-md-none">
                                    <div class="d-flex align-items-center justify-content-around w-100" id="nav-buttton-container">
                                        <a href="">
                                            <button class="btn btn-info nav-login-btn" style="font-weight: 500;font-size: 12px;!important;">
                                                <i class="feather icon-search" style=""></i>
                                                جستجو
                                            </button>
                                        </a>

                                    </div>

                                </li>
                                {{--                            <li>--}}
                                {{--                                <a href="#">Pages</a>--}}
                                {{--                                <ul>--}}
                                {{--                                    <li><a href="news.html">News</a></li>--}}
                                {{--                                    <li><a href="gallery.html">Gallery</a></li>--}}
                                {{--                                    <li><a href="login.html">Login</a></li>--}}
                                {{--                                    <li><a href="login-2.html">Login 2</a></li>--}}
                                {{--                                    <li><a href="register.html">Register</a></li>--}}
                                {{--                                    <li><a href="contact-us.html">Contact Us</a></li>--}}
                                {{--                                </ul>--}}
                                {{--                            </li>--}}
                                {{--                            <li>--}}
                                {{--                                <a href="#">test</a>--}}
                                {{--                                <ul>--}}
                                {{--                                    <li><a href="icons-font-awesome.html">Font Awesome Icons</a></li>--}}
                                {{--                                    <li><a href="icons-elegant.html">Elegant Icons</a></li>--}}
                                {{--                                    <li><a href="icons-etline.html">Etline Icons</a></li>--}}
                                {{--                                    <li><a href="alerts.html">Alerts</a></li>--}}
                                {{--                                    <li><a href="accordion.html">Accordion</a></li>--}}
                                {{--                                    <li><a href="modal.html">Modal</a></li>--}}
                                {{--                                    <li><a href="progress-bar.html">Progress Bar</a></li>--}}
                                {{--                                    <li><a href="tabs.html">Tabs</a></li>--}}
                                {{--                                    <li><a href="tabs.html">Timeline</a></li>--}}
                                {{--                                    <li><a href="counters.html">Counters</a></li>--}}
                                {{--                                </ul>--}}
                                {{--                            </li>--}}
                            </ul>
                        </div>
                        <div class="align-self-center header-col-left">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="{{url('/')}}">
                                    <img alt="" class="logo" src="images/logo.png" style=""/>

                                </a>

                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="d-block d-md-none">
                        <h6 class="text-center" style="font-size: 13px;line-height: 1.7;"> پورتال انتشارات <strong>دانشگاه صنعتی شریف</strong></h6>
                    </div>
                    <div class="d-block d-md-none">
                        <div class="align-self-center ml-auto header-col-right d-flex ">
                            <span id="menu-btn" class="" style="background: white!important;">
                                <div class="badge badge-pill badge-danger badge-up"  style="position: absolute;bottom: -12px;right:1px;padding: 0.4rem;border-radius: 5px;font-weight: 500;min-width: 22px;height: 20px"> <span id="bagCount3">{{count(\App\Helpers\Cart\Cart::all())}}</span></div>
                            </span>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</header>
<div class="modal fade " id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable text-right"  role="document">
        <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
            <div class="modal-header d-flex flex-row w-100 align-items-center justify-content-between">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="feather icon-search text-warning" style=""></i> جستجو کتاب</h5>
                <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="get" action="{{route('nav.search')}}">
                @csrf
                <div class="modal-body " id="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">بخشی از نام کتاب</label>
                                <input type="text" name="title" class="form-control px-2" id="title" placeholder="بخشی از نام کتاب وارد کنید" style="min-height: 40px; border: 1px gray solid;text-align: center;font-size: 14px"  required>
                            </div>
                        </div>
                    </div>
                 </div>
                <div class="modal-footer d-flex flex-row align-items-center justify-content-center w-100">
                <button type="submit" href="" class="btn btn-warning" id="" style="min-width: 150px">
                    <i class="feather icon-search"></i> جستجو
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade " id="bagModal" tabindex="-1" role="dialog" aria-labelledby="bagModal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable"  role="document">
        <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
            <div class="modal-header d-flex flex-row w-100 align-items-center justify-content-between">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="feather icon-shopping-bag text-danger" style="font-size: 20px"></i> جزییات سبد خرید شما - <span id="modalTitleCounter"> {{count(\App\Helpers\Cart\Cart::all())}} </span> مورد </h5>
                <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row" id="book-container">
                <h6 style="text-align: center;" class="m-auto d-none" id="noIcon">کالایی در سبد خرید شما وجود ندارد!</h6>


                @foreach(\App\Helpers\Cart\Cart::all() as $product)
                    @if(isset($product['book']))
                        @php
                            $book = $product['book'];
                            $quantity = $product['quantity'];

                        @endphp
                        <div class="d-flex flex-row align-items-center justify-content-start w-100 my-2 mb-1"  id="modal-book-card" >
                            <a href="" target="_blank" style="max-height: 140px;max-width: 100px">
                              <span class="book-wrap" >
                            <img class=" book-hover"  src="{{asset($book->image)}}"  alt="">
                        </span>
                            </a>
                            <div class="d-flex flex-column align-items-start mr-4" style="max-width: 35%" id="modal-book-card-text">
                                <p style="font-size: 13px;text-align: right;padding: 3px;padding-right: 10px;text-align: justify;color: black;min-width: 231px;">
                                     {{$book->title}} اثر
                                    @foreach ($book->authors as $author)
                                        {{$author->title}} -
                                    @endforeach
                                    <br>
                                    هر عدد : {{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}} تومان
                                </p>
                                @if($book->count > 0)
                                    <p class="text-right text-muted mb-1" style="font-size: 13px;line-height: 1.7">وضعیت : <span style="color: darkgreen"> <i class="feather icon-check-circle" ></i> موجود </span>  </p>
                                @else
                                    <p class="text-right text-muted mb-1" style="font-size: 13px;line-height: 1.7">وضعیت : <span style="color: darkred"> <i class="feather icon-slash" ></i> ناموجود </span>  </p>
                                @endif
                            </div>

                        </div>
                        <hr style="width: 75%;border-color: #dbdbdb;margin: auto">

                    @endif
                @endforeach
            </div>
            <div class="modal-footer d-flex flex-row align-items-center">
                <a href="{{route('cart.checkoutList')}}" class="btn btn-warning d-none" id="checkout-btn">
                    <i class="feather icon-check-circle"></i> ادامه و تکمیل خرید
                </a>
            </div>
        </div>
    </div>
</div>
