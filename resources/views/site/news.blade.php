@component('site.layouts.content',['title'=>'اخبار و اطلاعیه‌ها'])
    @slot('headerTitle')
        اخبار و اطلاعیه‌ها
    @endslot
    <ul class="breadcrumb d-none d-md-block text-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('news.index')}}">اخبار و اطلاعیه‌ها</a></li>
    </ul>
    <div class="row mt-2" style="direction: rtl">
        <div class="col-10 m-auto">
            <div class="row" style="border-bottom: 1px solid rgba(12,40,100,0.31);" id="newsCard">
                @foreach($news as $item)
                    <div class="col-md-3 col-sm-12 p-0 py-1 ">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <img src="{{asset($item->image)}}" id="newsImage" style="max-width: 95%;max-height: 100%;height: auto;width: auto;max-height: 150px" class="mt-sm-4 mt-md-1 handleNewImageResponsive" alt="عنوان خبر قرار بگیرد">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="d-flex flex-md-column w-100 align-items-center">
                            <div class="d-flex flex-column w-100 justify-content-start">
                                <a href="" class="text-dark text-right">
                                    <h4 class="my-1 pt-2 new-list-title">{{$item->title}}</h4>
                                </a>
                                <p style="line-height: 1.6;max-height: 90px;text-overflow: ellipsis;white-space: normal;overflow: hidden;font-size: 15px;padding-top: 6px" class="text-justify d-none d-md-block">
                                    {{$item->description}}
                                </p>
                                @if(strlen($item->attachment) > 1)
                                    <a href="{{asset($item->attachment)}}" download><i class="feather icon-download"></i> دریافت پیوست </a>
                                @endif
                                <div class="d-flex w-100 align-items-center justify-content-between  new-list-flex">
                                    {{--                                   <a href="" class="" > <i class="feather icon-arrow-left"></i> اطلاعات بیشتر </a>--}}

                                    <p class="mt-1  new-list-date">{{jdate($item->created_at)->format('%A, %d %B %y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
