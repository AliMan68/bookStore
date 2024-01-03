@component('admin.layouts.content')

    @slot('action')

    @endslot
    @slot('title')
{{--        {{request('type') == 'delivered' ? 'نیازمند بررسی' : 'بررسی شده' }} سفارشات--}}
        @if(request('type') == 'delivered')
             سفارشات بررسی شده
        @else
            سفارشات ارسال نشده
        @endif
    @endslot
    @slot('headerTitle')
{{--        {{request('type') == 'delivered' ? 'نیازمند بررسی' : 'بررسی شده' }} سفارشات--}}
        @if(request('type') == 'delivered')
             سفارشات بررسی شده
        @else
            سفارشات ارسال نشده
        @endif
    @endslot

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div>
                    <form action="" method="get">
                        <div class="input-group input-group-sm m-1 my-2" style="width: 250px;border: 1px solid lightgray;border-radius: 6px;">
                            <input type="hidden" name="type" value="{{request('type')}}">
                            <input type="text" name="search" value="{{request('search')}}" class="form-control float-right " style="border: none;font-size: 11px" placeholder="شماره سفارش یا نام کاربر">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($orders->count() > 0)
                <table class="table  table-hover-animation table-striped mb-0 w-100" style="direction: rtl" id="orders">
                    <thead>
                    <tr>
                        <th scope="col">شماره سفارش</th>
                        <th scope="col"> کاربر(شماره تماس)</th>
                        <th scope="col" style="min-width: 80px;">تاریخ ثبت</th>
                        <th scope="col">آدرس-کدپستی</th>
                        <th scope="col">مبلغ سفارش(ریال)</th>
                        @if(request('type') == 'delivered')
                        <th scope="col">کد رهگیری</th>
                        @endif
                        <th scope="col" style="min-width: 122px">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="">
                            <td scope="row">{{$order->id}}</td>
                            <td scope="row">{{$order->user->name}} ({{$order->user->phone}})</td>
                            <td>
                                {{jdate($order->created_at)->format('%d %B %Y')}}
                            </td>
                            <td>
                                @if($order->delivery_type == 'in_post')
                                    {{$order->receiver_address}} - {{$order->receiver_postal_code}}
                                @else
                                    حضوری
                                @endif
                            </td>
                            <td>{{number_format($order->price)}}</td>

                            @if(request('type') == 'delivered')
                            <td style="font-size: 11px">{{$order->tracking_code ?? 'تحویل حضوری'}}</td>
                            @endif
                            <td>
                                <button  data-toggle="modal" data-target="#orderDetails{{$order->id}}" class="btn btn-warning btn-sm" style="font-size: 10px!important;"> جزییات </button>
                                @if(request('type') == 'completed')
                                <button  data-toggle="modal" data-target="#orderSend{{$order->id}}" class="btn btn-primary btn-sm" style="font-size: 12px!important;"> ارسال </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="content-body my-5" style="margin-top: 7rem">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-shopping-bag mb-3" style="font-size: 3rem"></i>
                        <h1 class="text-black-50 text-center"><span></span>موردی وجود ندارد</h1>
                    </div>
                </div>
            @endif
                @if($orders->count() > 0)
                  @foreach($orders as $order)
                        <div class="modal fade " id="orderDetails{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderDetails{{$order->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                                    <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">جزییات سفارش شماره : {{$order->id}}</h5>
                                        <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body " style="color:black;">
                                        <div class="row">
                                            @if($order->delivery_type == 'in_post')
                                                <div class="col-md-12"><p class="rtl text-right" style="font-size:12px ">-استان،شهر : {{$order->receiver_state}},{{$order->receiver_city}}</p></div>
                                                <div class="col-md-12"><p class="rtl text-right" style="font-size:12px">-آدرس : {{$order->receiver_state}},{{$order->receiver_address}} , کد پستی : {{$order->receiver_postal_code}} </p></div>
                                            @else
                                                <div class="col-md-12"><p class="rtl text-right" style="font-size:12px ">-نوع تحویل : حضوری</p></div>
                                            @endif
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6"><p class="rtl text-right" style="font-size:12px ">-شماره مرجع تراکنش  : 329279467508</p></div>
                                                <div class="col-md-6"><p class="rtl text-right" style="font-size:12px ">-شماره پیگیری : 241667</p></div>
                                        </div>
                                        <table class="table  table-hover-animation table-striped mb-0 text-right " style="direction: rtl" id="orders">
                                            <thead>
                                            <tr>
                                                <th scope="col">عنوان کتاب</th>
                                                <th scope="col" style="min-width: 80px;">تعداد</th>
                                                <th scope="col" style="min-width: 80px;">مبلغ واحد</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->books()->get() as $book)
                                                <tr>
                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->pivot->quantity}}</td>
                                                    <td>{{$book->price}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if(request('type') == 'completed')
                          <div class="modal fade " id="orderSend{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="orderSend{{$order->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                            <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                                <h5 class="modal-title" id="exampleModalCenterTitle">ارسال/تحویل سفارش شماره : {{$order->id}}</h5>
                                <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body " style="color:black;">
                                <div class="row">
                                    <div class="col-md-12"><p class="rtl text-right" style="font-size:14px ">نام و شماره تماس تحویل گیرنده : {{$order->receiver_name}}{{$order->receiver_number}}</p></div>
                                    @if($order->delivery_type == 'in_post')
                                        <div class="col-md-12"><p class="rtl text-right" style="font-size:12px ">استان،شهر : {{$order->receiver_state}},{{$order->receiver_city}}</p></div>
                                        <div class="col-md-12"><p class="rtl text-right" style="font-size:12px ">آدرس : {{$order->receiver_state}},{{$order->receiver_address}}</p></div>
                                    @else
                                        <div class="col-md-12"><p class="rtl text-right" style="font-size:12px ">نوع تحویل : حضوری</p></div>
                                    @endif
                                </div>
                                <table class="table  table-hover-animation table-striped mb-0 text-right " style="direction: rtl" id="orders">
                                    <thead>
                                    <tr>
                                        <th scope="col">عنوان کتاب</th>
                                        <th scope="col" style="min-width: 80px;">تعداد</th>
                                        <th scope="col" style="min-width: 80px;">مبلغ واحد</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->books()->get() as $book)
                                        <tr>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->pivot->quantity}}</td>
                                            <td>{{$book->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <div class=" d-flex flex-column w-100 align-items-start justify-content-between">

                                        <form action="{{route('admin.order.deliver',$order->id)}}" method="post" id="sendOrder" class="row w-100">
                                            @csrf
                                            <input type="hidden" name="delivery_type" value="{{$order->delivery_type}}">
                                            <div class="col-12 d-flex align-items-center justify-content-between">
                                                @if($order->delivery_type == 'in_post')
                                                <div class="form-group">
                                                    <label for="tracking_code"> کد رهگیری پستی : </label>
                                                    <input type="number" value="0" class="form-control" id="tracking_code" name="tracking_code" placeholder="کد رهیگیری پستی را وارد نمایید"  style="min-width: 230px">
                                                </div>
                                                @endif
                                            </div>

                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                            <button class="btn btn-sm btn-success" type="submit"> <i class="feather icon-check"></i> تحویل/ارسال </button>
                                            <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                        @endif

                    @endforeach
                @endif
{{--            {{$orders->appends(['type'=>request('type'),'search'=>request('search')])->render()}}--}}
        </div>
    </div>

@endcomponent

