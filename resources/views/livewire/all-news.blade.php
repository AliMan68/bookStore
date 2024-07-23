<div class="container" id="" style="margin-top:6.9rem;height: auto;min-height: 260px">
    <ul class="breadcrumb d-none d-md-block text-right">
        <li class="breadcrumb-item"><a wire:navigate href="{{url('/')}}">خانه</a></li>
        <li class="breadcrumb-item">اخبار و اطلاعیه‌ها</li>
    </ul>
    <div class="row mt-2" style="direction: rtl">
        <div class="col-10 m-auto">
            <div class="row"  id="newsCard">
                @foreach($allNews as $item)
                    <div class="col-md-3 col-sm-12 p-0 py-1 ">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <img src="{{asset($item->image)}}" id="newsImage" style="max-width: 95%;max-height: 100%;height: auto;width: auto;max-height: 150px" class="mt-sm-4 mt-md-1 handleNewImageResponsive" alt="عنوان خبر قرار بگیرد">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="d-flex flex-md-column w-100 align-items-center" style="border-bottom: 1px solid rgba(12,40,100,0.31);">
                            <div class="d-flex flex-column w-100 justify-content-start">
                                <a wire:navigate href="" class="text-dark text-right">
                                    <h4 class="my-1 pt-2 new-list-title">{{$item->title}}</h4>
                                </a>
                                <p style="line-height: 1.6;max-height: 90px;text-overflow: ellipsis;white-space: normal;overflow: hidden;font-size: 15px;padding-top: 6px;color: #0b0b0b" class="text-justify d-none d-md-block">
                                    {{strlen($item->description) > 250 ? mb_substr($item->description,0,270,'utf-8')."..." : $item->description}}
                                </p>
                                <div class="d-flex w-100 align-items-center justify-content-between  new-list-flex">
                                    <a wire:navigate href="{{route('news.details',$item)}}" class="news__button" > <i class="feather icon-arrow-left"></i> اطلاعات بیشتر </a>

                                    <p class="mt-1  new-list-date">{{jdate($item->created_at)->format('%A, %d %B %y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>



        </div>
    </div>
        <div class="my-2">
            {{$allNews->links()}}
        <div/>
    </div>

</div>

@script
<script>
    document.addEventListener('livewire:navigated', () => {
        $('#navigation-menu').addClass("smaller")

    })
</script>
@endscript
