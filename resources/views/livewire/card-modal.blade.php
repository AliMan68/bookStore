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
                                <div class="row w-100">
                                    <div class="col-11">
                                        <div class="d-flex flex-row align-items-center justify-content-start w-100 my-2 mb-1 "  id="modal-book-card" >
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
                                    </div>
                                    <div class="col-1 d-flex align-items-center justify-content-center h-100">
                                        <form action="{{route('cart.delete',$product['id'])}}" id="removeBook{{$product['id']}}" method="post">@csrf @method('delete')</form>
                                        <button type="button" onclick="$('#removeBook{{$product['id']}}').submit()" class="bg-transparent btn d-flex align-items-center justify-content-center"><i class="feather icon-trash" style="color: red"></i></button>
                                    </div>
                                </div>
                            <hr style="width: 90%;border-color: #dbdbdb;margin: auto">
                    @endif
                @endforeach
            </div>

            @if(!\App\Helpers\Cart\Cart::isEmpty())
            <div class="modal-footer d-flex flex-row align-items-center">
                <a href="{{route('cart.checkoutList')}}" class="btn btn-warning " id="checkout-btn">
                    <i class="feather icon-check-circle"></i> ادامه و تکمیل خرید
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
