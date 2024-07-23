<div>
    <section id="subheader" class="py-md-2" data-bgimage="url(images/background/5.png) bottom" style="min-height: calc(13vh)">
        <div class="row">
            <div class="col-md-10 col-sm-12 m-auto">
                <form wire:submit="search">
                    <div class="wrapSearch my-md-4">
                        <div class="search">
                            <input type="text" wire:model="title"  name="title" class="searchTerm" placeholder="عنوان کتاب را وارد نمایید">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="component-swiper-centered-slides">
        <div class="card bg-transparent shadow-none" style="border:none ">
            <div class="card-header  text-right d-flex align-items-center justify-content-between w-100" style="border-bottom: none">
                <a href="{{url('/books/index')}}" class="">
                    <h4 class="card-title see-all">  مشاهده همه <i class="feather icon-arrow-left-circle"></i></h4>
                </a>
                <h5 class="see-sections" style="font-size: 22px" id="categories">  دسته‌بندی‌ها <span style="font-size: 10px">(تعداد)</span> <i class="feather icon-list"></i></h5>
            </div>
            <div class="card-content" style="background-color: rgba(0,0,0,.03);">
                <div class="card-body pt-0">
                    <div class="swiper-multiple swiper-container" style="direction: rtl">
                        <div class="swiper-wrapper py-2">
                            @foreach(\App\Models\Category::all() as $category)
                                <button  type="button" wire:click="searchCategory({{$category}})"  class="swiper-slide rounded swiper-shadow d-flex  @if(\Illuminate\Support\Facades\Request::path() == 'category/'.$category->id.'/books') active @endif"

                                >
                                    @if(\Illuminate\Support\Facades\Request::path() == 'category/'.$category->id.'/books')
                                        <i class="feather icon-arrow-left-circle " style="margin-left: 3px;margin-top: 6px"></i>
                                    @endif
                                    <div class="swiper-text">{{$category->title}} - {{$category->books->count()}}</div>
                                </button>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        {{--                            <div class="swiper-pagination"></div>--}}
                    </div>
                </div>
                <div class="container mb-2">
                    <div class="card mx-2">
                        <div class="card-content">
                            <div class="card-body  w-100 row">
                                @foreach($books as $book)
                                    <div class="ProductWrapper  col-md-3 col-sm-12 m-sm-auto" title="{{$book->title}}">
                                        <div class="body">
                                            <div class="product-image-wrapper">
                                                <a href="{{route('book.details',$book)}}" wire:navigate>
                                                         <span class="book-wrap" title="{{$book->title}}">
                                                                <img class=" book-hover"  src="{{asset($book->image)}}"  alt="{{$book->title}}">
                                                         </span>
                                                </a>
                                                <img src="" style="position: absolute;left: 0px;top:0px;max-width: 55px;height: auto" alt="">
                                                <div class="video-card-gradient-overlay" >
                                                    <div class="d-flex w-100 align-items-center justify-content-center">
                                                        <p class="text-white " title="{{$book->title}}" style="font-size: 14px" onclick="addToBag('{{$book->title}}','@foreach ($book->authors as $author)
                                                        {{$author->title}} -
                                                        @endforeach','{{asset($book->image)}}','{{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}}','{{$book->id}}')"> <span id="addOverlayText{{$book->id}}">افزودن به سبد خرید</span> <i class="feather icon-shopping-bag"></i></p>

                                                    </div>
                                                </div>

                                            </div>
                                            <a href="{{route('book.details',$book)}}" wire:navigate>
                                                <div class="text">
                                                    کتاب {{$book->title}} اثر

                                                    @foreach ($book->authors as $author)
                                                        {{$author->title}} -
                                                    @endforeach
                                                    انتشارات نگین ایران
                                                </div>
                                                @if($book->discount_percent > 0)
                                                    <div class="price" >
                                                        <span class="offed-price"> {{number_format($book->price)}}  </span>
                                                        <span  class="off-percent"> {{$book->discount_percent}}%</span>
                                                        <div class="price">
                                                            {{number_format( (int)($book->price - ($book->price * $book->discount_percent/100)))}} تومان
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price">
                                                        {{number_format($book->price)}} تومان
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
