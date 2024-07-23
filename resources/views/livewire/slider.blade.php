

<div class="blog-slider__item swiper-slide">
        <div class="blog-slider__img d-block d-md-none">
            <img src="{{asset($news->image)}}" alt="">
        </div>
        <div class="blog-slider__content">
            <span class="blog-slider__code d-none d-md-block ">در {{jdate($news->created_at)->format('%d %B %Y')}}</span>
            <div class="blog-slider__title">{{$news->title}}</div>
            {{--                                            <div class="blog-slider__text d-none d-md-block" >{{$news->description}}</div>--}}
            <div class="blog-slider__text d-none d-md-block" >{{strlen($news->description) > 50 ? mb_substr($news->description,0,70,'utf-8')."..." : $news->description}}</div>

            <a  href="{{route('news.details',$news)}}" class="blog-slider__button" target="_blank">اطلاعات بیشتر</a>

        </div>
        <div class="blog-slider__img d-none d-md-block">
            <img src="{{asset($news->image)}}" alt="">
        </div>
</div>

