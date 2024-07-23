<div class="no-bottom no-top" id="content" style="font-family: IranYekan!important;">
    <div class="position-relative" id="slider-section" >
            <div class="gradient-overlay "></div>
            <div class="hero" style="background-image: url('{{asset('/images/monitoring.jpeg')}}');">
                <div class="overlay-gradient t50">
                    <div class="blog-slider">
                        <div class="blog-slider__wrp swiper-wrapper">
                            @foreach($slider_items as $news)
                                <livewire:slider :news="$news" :key="$news->id">
                            @endforeach
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
{{--                    @foreach($slider_items as $news)--}}
{{--                        <div wire:key="{{$news->id}}"  class="carousel-item text-center text-white  ">--}}
{{--                            <a href="{{route('news.details',$news)}}" class="text-white" target="_blank">{{strlen($news->title) > 50 ? mb_substr($news->title,0,70,'utf-8')."..." : $news->title}}</a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

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
    <livewire:index-search/>

</div>






@script
<script>
    document.addEventListener('livewire:navigated', () => {
        $('#navigation-menu').removeClass("smaller")
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

    })

</script>
@endscript
