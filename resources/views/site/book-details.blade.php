@component('site.layouts.content',['title'=>' کتاب‌ها'])
    @slot('headerTitle')
        جزییات کتاب {{$book->title}}
    @endslot
    <ul class="breadcrumb d-none d-md-block text-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('books.index')}}">کتاب‌</a></li>
        <li class="breadcrumb-item active">{{$book->title}}</li>
    </ul>
    <div class="row mt-2" style="direction: rtl">
        <div class="col-md-2 col-sm-12 m-auto d-flex align-items-center justify-content-start w-100 h-100" id="book-details-image-flex">
            <div class="book-details-image">
                <img src="{{strlen($book->image != null) ? asset($book->image) : asset('images/book-placeholder.png')}}"  style="border-radius: 10px;">
                @if($book->discount_percent > 0)
                    <p class="book-card-off">%{{$book->discount_percent}}</p>
                @endif
            </div>
        </div>
        <div class="col-md-10 col-12">
            <div class="card w-100 h-100" style="background-color: #f5f5f5;;border-radius: 10px;padding: 10px;border: 1px #06069708 solid;box-shadow: rgba(41, 0, 0, 0.15) 0px 2px 6px 0px">
                <div class="d-flex flex-row align-items-center justify-content-between w-100 h-100" id="main-book-flex-box">
                    <div class="d-flex flex-column align-items-start justify-content-between h-100">
                        <h1 style="font-size: 20px;font-weight: 500">{{$book->title}}</h1>
                        <ul class="book-details-list">
                            <li>
                                <p> نویسنده :
                                    @foreach ($book->authors as $author)
                                          {{$author->title}} -
                                    @endforeach
                                </p>
                            </li>
                            @if($book->translators()->count() > 0)
                                <li>
                                    <p> مترجم :
                                        @foreach ($book->translators as $translator)
                                            {{$translator->title}} -
                                        @endforeach
                                    </p>
                                </li>
                            @endif
                            @if($book->categories->count() > 0)
                                <li>
                                    <p> دسته‌بندی :
                                        @foreach ($book->categories as $category)
                                            {{$category->title}} -
                                        @endforeach
                                    </p>
                                </li>
                            @endif
                            <li>
                                <p> انتشارات : انتشارات ماه آوا</p>
                            </li>

                            <li>
                                <p > سایر اطلاعات : <a data-toggle="modal" data-target="#moreInfo" style="cursor: pointer;color: #007bff;"><i class="feather icon-eye"></i> مشاهده </a> </p>
                            </li>
                            @if(strlen($book->attachment)>1)
                                <li>
                                    <p> صفحات اول کتاب : <a href="{{Illuminate\Support\Facades\URL::to('/') .'/'.$book->attachment}}" download><i class="feather icon-download"></i> دریافت </a> </p>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="d-flex flex-column align-items-center" style="width: 350px">

                        @if($book->count >0)
                            @if(!(\App\Helpers\Cart\Cart::has($book)) )
                                <button class="blog-slider__button d-flex align-items-center justify-content-center w-100" onclick="$('#addToCardForm').submit()" style="width: 100%;max-width: 274px;max-height: 52px;border: none;box-shadow: none" id="details-button">
                                    <div style="display: flex;padding: 0 10px;text-align: center;min-height: 32px" class="align-items-center w-100 justify-content-around" >
                                        <p style="font-size: 18px;padding-left: 5px;color: whitesmoke;margin-bottom: 0px"> خرید </p>
                                        <div style="padding: 10px 2px">|</div>
                                        <div class="d-flex flex-column align-items-center justify-content-around">
                                            <p style="font-size: 10px;color: whitesmoke;text-decoration: line-through;margin-bottom: 0px" class="d-none d-md-block"> {{number_format($book->price)}} تومان </p>
                                            <p style="font-size: 15px;color: whitesmoke;margin-bottom: 0px"> {{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}} تومان </p>
                                        </div>
                                    </div>
                                </button>

                            @else
                                <button class="blog-slider__button d-flex align-items-center justify-content-center w-100"style="width: 100%;max-width: 274px;max-height: 52px;border: none;box-shadow: none" id="details-button">
                                    <div style="display: flex;padding: 0 10px;text-align: center;min-height: 32px" class="align-items-center w-100 justify-content-around" >
                                        <p style="font-size: 18px;padding-left: 5px;color: whitesmoke;margin-bottom: 0px;font-size: 11px"><i class="feather icon-check-circle"></i> این محصول در سبد خرید موجود است</p>
                                    </div>
                                </button>
                            @endif
                        @else
                            <button class="blog-slider__button d-flex align-items-center justify-content-center w-100"style="width: 100%;max-width: 274px;max-height: 52px;border: none;box-shadow: none" id="details-button">
                                <div style="display: flex;padding: 0 10px;text-align: center;min-height: 32px" class="align-items-center w-100 justify-content-around">
                                    <p style="font-size: 18px;padding-left: 5px;color: whitesmoke;margin-bottom: 0px;font-size: 11px"><i class="feather icon-check-circle"></i>ناموجود</p>
                                </div>
                            </button>
                        @endif

                        <form action="{{route('card.add',$book->id)}}" method="post" id="addToCardForm">
                            @csrf
                        </form>
                        <div class="d-none d-md-block">
                            <ul class="mt-4 " style="display: inline-block;!important;display: flex">
                                <li style="list-style-type: none;" class="ml-2">
                                    <a style="cursor: pointer" id="comment-btn" class="text-muted"><i class="feather icon-message-circle"></i> نظرات </a>
                                </li>
                                <li style="list-style-type: none;" class="ml-2">
                                    |
                                </li>
                                <li style="list-style-type: none;">
                                    <a id="about" style="cursor: pointer" class="text-muted"><i class="feather icon-edit"></i> معرفی کتاب</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 d-flex w-100" id="about-book">
            <h2 style="font-size: 1.2rem;letter-spacing: 1px;direction: rtl;text-align: right;margin-top: 12px"> معرفی کتاب {{$book->title}} </h2>
        </div>
        <div class="col-12 d-flex w-100">
            <p style="font-size: 16px;text-align: justify;margin-top: 6px; font-size: 16px;line-height: 30px;" >
                {{$book->about}}
            </p>
        </div>
        <div class="col-12 mt-4" id="comments">

            <div class="card w-100 h-100 =" style="background-color: #f5f5f5;;border-radius: 10px;padding: 10px;border: 1px #06069708 solid;box-shadow: rgba(41, 0, 0, 0.15) 0px 2px 6px 0px">

                @if($book->comments()->where('approved','=','1')->count() > 0)
                    <div class="d-flex flex-row align-items-center justify-content-between w-100 h-100" id="main-book-flex-box">
                    <div class="d-flex flex-row align-items-start justify-content-between h-100 w-100" id="comment-flex">
                        <h1 style="font-size: 18px;font-weight: 500" class="text-right"><i class="feather icon-message-circle"></i> نظرات <span>کاربران درباره این کتاب</span> </h1>
                        <p class="mt-1 p-1 text-muted" href="" style="background: white;border: 1px #ccc solid;font-size: 11px;cursor: pointer;border: 1px solid #07307c" data-toggle="modal" data-target="#comment"> <i class="feather icon-edit"></i> نظر خود را بنویسید </p>
                    </div>
                </div>
                    @foreach($book->comments()->where('approved','=','1')->get() as $comment)
                        <div class="{{!$loop->first ? 'mt-4' : ''}}" style="">
                            <div class="d-flex flex-row w-100">
                                <p style="font-size: 13px;color: #444444;text-align: justify;line-height: 1.7">
                                    {{$comment->comment}}
                                </p>
                            </div>
                            <div class="d-flex flex-row-reverse mt-1 w-100 " style="{{!$loop->last ? 'border-bottom: 1px gray dotted' : ''}}">
                                <p style="font-size: 11px;color: #444444;text-align: justify;line-height: 1.7" class="d-none d-md-block" >
                                     {{jdate($comment->created_at)->ago()}}   توسط <strong> {{$comment->user->name}} </strong> <span style="background:#002a79;padding:5px;color: white;font-size: 9px" class="mx-1"> خریدار این کتاب </span>  ثبت شده.
                                </p>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-4 d-flex flex-column align-items-center justify-content-center" style="">
                        <h5>تاکنون نظری برای این کتاب ثبت نشده است.شما اولین نفر باشد:</h5>
                        <p class="mt-1 px-3 p-1 text-muted" href="" style="background: white;border: 1px #ccc solid;font-size: 11px;cursor: pointer;border: 1px solid #07307c" data-toggle="modal" data-target="#comment"> <i class="feather icon-edit"></i>ثبت نظر</p>
                    </div>
                @endif



            </div>
        </div>

    </div>


    <div class="modal fade " id="comment" tabindex="-1" role="dialog" aria-labelledby="comment" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-scrollable"  role="document">
            <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                <div class="modal-header d-flex flex-row w-100 align-items-center justify-content-between">
                    <h5 class="modal-title" id=""><i class="feather icon-edit " style="font-size: 20px"></i> ارسال نظر برای کتاب {{$book->title}}</h5>
                    <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row" id="">
                    @auth()
                        <form class="form w-100 my-1 mx-2 mb-0" method="post" action="{{route('send.comment')}}">
                            @csrf
                            <input type="hidden" name="commentable_type" value="{{get_class($book)}}">
                            <input type="hidden" name="commentable_id" value="{{$book->id}}">
                            <input type="hidden" name="parent_id" value="0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comment" class="d-flex">نظر یا دیدگاه خود را درج کنید :</label>
                                        <textarea type="text"  class="form-control required" id="comment " name="comment" rows="9" required></textarea>
                                    </div>
                                </div>
                                <div class="col-4 mr-auto">
                                    <button type="submit" href="" class="btn btn-warning" id="">
                                        <i class="feather icon-check-circle"></i>ارسال
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endauth
                    @guest()
                            <div class="row">
                                {{--                        <div class="col-md-12">--}}
                                {{--                            <div class="form-group d-flex flex-column align-items-center ">--}}
                                {{--                                <label for="comment" class="d-flex text-right p-2" style="background: #22adad63; color: #0078d0;border-radius: 4px">برای درج نظر یا دیدگاه باید ابتدا وارد حساب کاربری خود شوید یا اگر عضو نیستید حساب کاربری ایجاد کنید :</label>--}}
                                {{--                                <input type="number" style="width: 300px;border: 1px dimgray solid;border-radius: 5px;text-align: center;margin-top:25px;margin-bottom:45px"  class="form-control required" id="comment " name="" placeholder="شماره همراه خود را وارد نمایید" required>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                {{--                        <hr>--}}
                                {{--                        <col-12>--}}
                                {{--                            <hr>--}}
                                {{--                        </col-12>--}}
                                <div class="col-10 m-auto">
                                    <label for="comment" class="d-flex text-right p-2" style="background: #22adad63; color: #0078d0;border-radius: 4px">برای درج نظر یا دیدگاه باید ابتدا وارد حساب کاربری خود شوید یا اگر عضو نیستید حساب کاربری ایجاد کنید :</label>
                                </div>

                                <div class="col-4 m-auto">
                                    <a  type="submit" href="{{url('/auth/login')}}" class="btn btn-warning" id="">
                                        <i class="feather icon-check-circle"></i>ورود/عضویت
                                    </a>
                                </div>
                            </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="moreInfo" tabindex="-1" role="dialog" aria-labelledby="moreInfo" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-scrollable"  role="document">
            <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                <div class="modal-header d-flex flex-row w-100 align-items-center justify-content-between">
                    <h5 class="modal-title" id=""><i class="feather icon-info " style="font-size: 20px"></i>سایر اطلاعات کتاب</h5>
                    <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row" id="">
                    <div class="row m-2 text-right">
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p >
                                تعداد صفحات : <strong>  {{$book->page_count}}</strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p >
                                ویراستار : <strong>علی عربگری </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                شابک - ISBN : <strong> 978-964-386-493-4 </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                شمارگان - تیراژ : <strong>   200 </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                نوبت چاپ : <strong> 1 </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                فروست انتشارات : <strong>   800 </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                قطع : <strong>     وزیری </strong>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-black-50">
                            <p>
                                نوع جلد : <strong>     شومیز </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @slot('script')
        <script>
            $(window).load(function() {
                $('#navigation-menu').addClass("smaller")
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
    @endslot
@endcomponent
