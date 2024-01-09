@component('site.layouts.content',['title'=>' جزییات خبر'])
    @slot('headerTitle')
        جزییات خبر {{$news->title}}
    @endslot
    <ul class="breadcrumb d-none d-md-block text-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href="{{route('news.index')}}">اخبار و اطلاعیه‌ها</a></li>
        <li class="breadcrumb-item active">{{$news->title}}</li>
    </ul>
    <div class="row mt-2" style="direction: rtl">
        <div class="col-md-8 col-sm-12 m-auto">
            <div class="row" style="border-bottom: 1px solid rgba(12,40,100,0.63);" id="newsCard">
                <div class="col-12 p-0 py-1 ">
                    <div class="d-flex align-items-center justify-content-center w-100">
                        <img src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759872/kuldar-kalvik-799168-unsplash.webp" id="newsImage" class="mt-sm-4 mt-md-1 handleNewImageResponsive" alt="عنوان خبر قرار بگیرد">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 pr-0">
                    <div class="d-flex flex-md-column w-100 align-items-center">
                        <div class="d-flex flex-column w-100 justify-content-start">
                            <a href="" class="text-dark text-right">
                                <h4 class="my-1 new-details-title">{{$news->title}}</h4>
                            </a>
                            <p style="line-height: 1.6;text-overflow: ellipsis;overflow: auto;color: #212121" class="text-justify">
                                {{$news->description}}

                            </p>
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <p class="mt-1">{{jdate($news->created_at)->format('%A, %d %B %y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <div class="card d-none d-md-block p-0" style="background: rgb(235, 231, 223) none repeat scroll 0% 0% / cover;direction: rtl;text-align: right">
                <div class="d-flex align-items-center justify-content-between p-1 mx-1">
                    <h6 class="pr-1 mt-2 mr-1" style="font-size: 12px;font-weight: 500"><i class="feather icon-message-square"></i> آخرین اخبار و اطلاعیه‌ها</h6>
                </div>
                <div class="card-body p-0">
                    @foreach($latestNews as $latest)
                        <div class="dashboard-box" style="border-bottom: 1px solid rgba(2, 117, 216, 0.4)">
                            <a href="{{route('news.details',$latest)}}" target="_blank">
                                <div class="dashboard-box-title">
                                    <i class="feather icon-info"></i>
                                    {{$latest->title}} - {{jdate($latest->created_at)->format('%A, %d %B %y')}}
                                </div>
                            </a>
                        </div>
                    @endforeach
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
