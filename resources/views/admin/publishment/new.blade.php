@component('admin.layouts.content',['title'=>'درخواست چاپ جدید'])
    @slot('headerTitle')
        درخواست چاپ‌ جدید
    @endslot

    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">

            <form class="form new-book" method="post" action="{{route('admin.publish-request.store')}}" enctype="multipart/form-data">
                @csrf
                <div style="direction: rtl" class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="request-number">*شماره درخواست :</label>
                            <input type="text" id="request-number" class="form-control required " name="request_number"  value="" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="date">*تاریخ :</label>
                            <input type="text" id="date" class="form-control required date-picker" name="request_date"  value="" placeholder="مثلا ۱۴۰۱/۱۲/۰۱" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="request-attachment">پیوست:</label>
                            <input type="file" id="request-attachment" class="form-control " name="attachment" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="amount1">مبلغ کل درخواست :</label>
                            <input type="text" id="amount1" class="form-control number-divider required" required name="total_amount" value="" placeholder="به تومان" >
                        </div>
                    </div>
                    <div class="divider mt-3"></div>
                    <div class="col-md-4 col-sm-12" style="direction: rtl;text-align: right">
                        <div class="form-group">
                            <label for="bookTitle1">*انتخاب کتاب : </label>
                            <select class="form-control select2" id="bookTitle1" name="book[]" >
                                @foreach($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="count">*تعداد :</label>
                            <input type="number" id="count" class="form-control required" name="count[]" placeholder="عدد وارد نمایید" required value="0">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <div class="d-flex flex-row align-items-center justify-content-between" style="position: absolute;left: 34px;bottom: 40px">
                                <span ><i onclick="insertNewBook()" class="feather icon-plus-circle" data-toggle="tooltip" data-placement="left" title="انتخاب کتاب جدید" style="font-size: 1.7rem;color: darkcyan;cursor: pointer"></i></span>
                                <span ><i onclick="removeLastBook()" class="feather icon-minus-circle" data-toggle="tooltip" data-placement="left" title="حذف کتاب " style="font-size: 1.7rem;color: darkred;cursor: pointer"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="bookContainer">

                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-plus-circle"></i>ثبت درخواست
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="bookCountDeliver" class="d-none">1</div>

        </div>
    </div>

    @slot('script')

        <script>
            $('#bookTitle1').select2()
            function insertNewBook() {
                let counter = parseInt($('#bookCountDeliver').text());
                counter = counter + 1;
                $('#bookCountDeliver').text(counter)
                const div = document.createElement('div');
                div.classList.add('row')
                div.classList.add('w-100')
                div.classList.add('px-0')
                div.setAttribute("id","bookItemContainer"+counter);
                div.innerHTML = `
                                <div class="col-md-4 col-sm-12" style="direction: rtl;text-align: right">
                                        <div class="form-group">
                                            <label for="bookTitle`+counter+`">*انتخاب کتاب : </label>
                                            <select id="bookTitle`+counter+`" name="book[]"  class="form-control select2">
                                                @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}}</option>
                                                @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="count`+counter+`">*تعداد :</label>
                <input type="number" id="count`+counter+`" class="form-control required" name="count[]" value="0" placeholder="عدد وارد نمایید" required>
            </div>
        </div>
<div class="divider "></div>

`;

                document.getElementById('bookContainer').appendChild(div);
                // activeSelect(counter)

                $("bookTitle"+counter).select2
            }
            function removeLastBook(){
                $('#bookContainer').children().last().remove();
            }
        </script>
        @endslot


@endcomponent
