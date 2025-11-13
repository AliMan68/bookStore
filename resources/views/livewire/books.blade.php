<div class="container" id="" style="margin-top:6.9rem;height: auto;min-height: 260px">
    <ul class="breadcrumb d-none d-md-block text-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}" wire:navigate>خانه</a></li>
        <li class="breadcrumb-item active">کتاب‌ها</li>

    </ul>
    <div class="d-flex w-100 align-items-center justify-content-end">
        <button class="btn btn-warning d-md-none d-sm-block mb-1" onclick="toggleFilters()">
            فیلتر‌ها
            <i class="feather icon-filter"></i>
        </button>
    </div>
{{--    <form action="" method="get" id="searchForm2">--}}
{{--        <section class="row rtl d-none d-md-none" id="filter-column">--}}
{{--            <div class="card  col-sm-12"  style="background: #f7f7f7;direction: rtl;text-align: right">--}}
{{--                <h5 class="pr-1 mt-1">فیلتر :</h5>--}}
{{--                <div class="card-body p-0">--}}
{{--                    <div class="filter-box">--}}
{{--                        <div class="filter-box-title">--}}
{{--                            جستجو در کتاب‌ها--}}
{{--                        </div>--}}
{{--                        <div class="search-input">--}}
{{--                            <i class="feather icon-search" onclick="$('#searchForm2').submit()"></i>--}}
{{--                            <input wire:model="title" type="text" class="form-control" placeholder="عنوان کتاب" name="title" >--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="filter-box">--}}
{{--                        <div class="filter-box-title">--}}
{{--                            دسته‌بندی :--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <label class="">--}}
{{--                                    {{$category->title}} <span style="font-size: 10px">({{$category->books->count()}} عدد)</span>--}}
{{--                                    @if($categories_id)--}}
{{--                                        <input type="checkbox" wire:model="categories"  name="categories[]" value="{{$category->id}}" @if(in_array($category->id,$categories_id)) checked @endif>--}}
{{--                                    @else--}}
{{--                                        <input type="checkbox" wire:model="categories"  name="categories[]" value="{{$category->id}}" >--}}
{{--                                    @endif--}}
{{--                                </label>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="filter-box" style="">--}}
{{--                        <div class="filter-box-title">--}}
{{--                            نویسنده یا مترجم :--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">--}}
{{--                            @foreach($authors as $author)--}}
{{--                                <label class="">--}}
{{--                                    {{$author->title}} <span style="font-size: 10px">({{$author->books->count()}} عدد)</span>--}}
{{--                                    @if($authors_id)--}}
{{--                                        <input type="checkbox" wire:model="authors"  name="authors[]" value="{{$author->id}}" @if(in_array($author->id,$authors_id)) checked @endif>--}}
{{--                                    @else--}}
{{--                                        <input type="checkbox" wire:model="authors" name="authors[]" value="{{$author->id}}" >--}}
{{--                                    @endif--}}

{{--                                </label>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="filter-box" style="">--}}
{{--                        <div class="filter-box-title">--}}
{{--                            مترجم :--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">--}}
{{--                            @foreach($translators as $translator)--}}
{{--                                <label class="">--}}
{{--                                    {{$translator->title}} <span style="font-size: 10px">({{$translator->books->count()}} عدد)</span>--}}
{{--                                    @if($authors_id)--}}
{{--                                        <input type="checkbox" wire:model="translators"  name="translators[]" value="{{$translator->id}}" @if(in_array($translator->id,$authors_id)) checked @endif>--}}
{{--                                    @else--}}
{{--                                        <input type="checkbox"   wire:model="translators" value="{{$translator->id}}" >--}}
{{--                                    @endif--}}
{{--                                </label>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button class="btn filter-submit">--}}
{{--                        <i class="feather icon-search"></i>--}}
{{--                        جستجو--}}
{{--                    </button>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </form>--}}
    <form wire:submit="search">
        <section id="" class="row rtl">
            <div class="card bg-transparent shadow-none col-md-9 col-sm-12" style="border:none ">
                <div class="card-header  text-right d-flex align-items-center justify-content-between w-100 index-section-flex" style="border-bottom: none">
                    <select class="price-options form-control d-none d-md-block" wire:model="pricing" name="pricing" style="width: auto;text-align: right;direction: rtl" >
                        <option value="ارزانترین" @if(request('pricing') == "ارزاترین") selected @endif >ارزاترین</option>
                        <option value="گرانترین" @if(request('pricing') == "گرانترین") selected @endif>گرانترین</option>
                    </select>
                    <div class="d-flex ">
                        <h5 style="font-size: 14px">  تعداد نتایج : {{$books->count()}} </h5>
                    </div>
                </div>
                <div class="card-content" style="background-color: rgba(0,0,0,.03);">
                    <div class="card mx-2 mb-2">
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
                                                        <p class="text-white " title="{{$book->title}}" style="font-size: 14px" onclick="">افزودن به سبد خرید</span> <i class="feather icon-shopping-bag"></i></p>

                                                    </div>
                                                </div>

                                            </div>
                                            <a href="{{route('book.details',$book)}}" wire:navigate>
                                                <div class="text">
                                                     {{$book->title}}
                                                    اثر
                                                    {{$book->authors()->first()->title ?? 'نامشخص'}}
                                                </div>
                                                @if($book->count >0)
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
                                                @else
                                                    <div class="price">
                                                        ناموجود
                                                    </div>
                                                @endif

                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                                {{$books->links()}}

                        </div>
                    </div>
                </div>



            </div>
            <div class="card col-md-3 d-none d-md-block" style="background: #f7f7f7;direction: rtl;text-align: right">
                <h5 class="pr-1 mt-2">فیلتر :</h5>
                <div class="card-body p-0">
                    <div class="filter-box">
                        <div class="filter-box-title">
                            جستجو در کتاب‌ها
                            <span wire:loading>
                              <small class="text-center text-black-50">در حال جستجو...</small>
                          </span>
                        </div>
                        <div class="search-input">
                            <i class="feather icon-search" @click="$wire.search"></i>
                            <input type="text" wire:model="title" class="form-control" placeholder="عنوان کتاب" name="title" style="font-size: 12px" value="{{$title ?? '' }}">
                        </div>
                    </div>
                    <div class="filter-box">
                        <div class="filter-box-title">
                            دسته‌بندی :
                        </div>
                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">

                            @foreach( \App\Models\Category::all() as $category)
                                <label wire:key="{{$category->id}}" class="">
                                    {{$category->title}} <span style="font-size: 10px">({{$category->books->count()}} عدد)</span>

                                    @if($categories_id)
                                        <input type="checkbox" wire:model="categories"  name="categories[]" value="{{$category->id}}" @if(in_array($category->id,$categories_id)) checked @endif>
                                    @else
                                        <input type="checkbox" wire:model="categories"  name="categories[]" value="{{$category->id}}" >
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-box" style="">
                        <div class="filter-box-title">
                            نویسنده :
                        </div>
                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">
                            @foreach(\App\Models\Author::all() as $author)
                                <label class="">
                                    {{$author->title}} <span style="font-size: 10px">({{$author->books->count()}} عدد)</span>
                                    @if($authors_id)
                                        <input type="checkbox" wire:model="authors"  name="authors[]" value="{{$author->id}}" @if(in_array($author->id,$authors_id)) checked @endif>
                                    @else
                                        <input type="checkbox" wire:model="authors"  name="authors[]" value="{{$author->id}}" >
                                    @endif

                                </label>
                            @endforeach
                        </div>

                    </div>
                    <div class="filter-box" style="">
                        <div class="filter-box-title">
                            مترجم :
                        </div>
                        <div class="d-flex flex-column px-2" style="max-height: 185px;overflow-y: scroll">
                            @foreach(\App\Models\Translator::all() as $translator)
                                <label class="">
                                    {{$translator->title}} <span style="font-size: 10px">({{$translator->books->count()}} عدد)</span>
                                    @if($translators_id)
                                        <input type="checkbox" wire:model="translators"  name="translators[]" value="{{$translator->id}}" @if(in_array($translator->id,$translators_id)) checked @endif>
                                    @else
                                        <input type="checkbox"  wire:model="translators" name="translators[]" value="{{$translator->id}}" >
                                    @endif
                                </label>
                            @endforeach
                        </div>

                    </div>
                    <button class="btn filter-submit" type="submit" >
                        <i class="feather icon-search"></i>
                        جستجو
                    </button>

                </div>
            </div>
        </section>
    </form>

</div>
@script
<script>
    document.addEventListener('livewire:navigated', () => {
        $('#navigation-menu').addClass("smaller")
        $('#category').select2()
        function toggleFilters() {
            $('#filter-column').toggleClass('d-none')
        }
    })
</script>
@endscript
