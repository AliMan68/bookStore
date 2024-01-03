@component('admin.layouts.content',['title'=>'ویرایش تحویل'])
    @slot('headerTitle')
        ویرایش تحویل
    @endslot

    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <p style="font-size: 1.2rem;color: #0F1642">  ویرایش تحویل کتاب  <i class="feather icon-plus-circle"></i></p>
            <form class="form new-book" method="post" action="">
                <div style="direction: rtl" class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="transferee">*تحویل گیرنده :</label>
                            <input type="text" id="transferee" class="form-control required" name="transferee" value="" placeholder="نام کامل" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="deliver_date">*تاریخ تحویل :</label>
                            <input type="text" id="deliver_date" class="form-control required date-picker" name="deliver_date"   value="" placeholder="مثلا ۱۴۰۱/۱۲/۰۱" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="attachment">پیوست(نامه،دستور) :</label>
                            <input type="file" id="attachment" class="form-control " name="attachment" >
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-between" style="position: absolute;left: 10px;bottom: -20px">
                            <span ><i onclick="insertNewBook()" class="feather icon-plus-circle" data-toggle="tooltip" data-placement="left" title="انتخاب کتاب جدید" style="font-size: 1.7rem;color: darkcyan;cursor: pointer"></i></span>
                            <span ><i onclick="removeLastBook()" class="feather icon-minus-circle" data-toggle="tooltip" data-placement="left" title="حذف کتاب " style="font-size: 1.7rem;color: darkred;cursor: pointer"></i></span>
                        </div>
                    </div>
                    <div class="divider mt-3"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="book">*انتخاب کتاب : </label>
                            <select name="book" id="book"  class="select2">
                                @foreach($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="count">*تعداد :</label>
                            <input type="number" id="count" class="form-control required" name="count" value="0" placeholder="تعداد کتاب تحویلی" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="minus_stock">آیا از موجودی سایت کسر شود؟</label>
                            <select name="minus_stock" id="minus_stock">
                                <option value="0" selected>خیر</option>
                                <option value="1">بله</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-12" id="bookContainer">

                    </div>
                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-edit"></i>ویرایش
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade " id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content" style=" position: absolute;top: 30px;direction: rtl">
                <div class="modal-header d-flex w-100 align-items-center justify-content-between">
                    <h5 class="modal-title" id="exampleModalCenterTitle">حذف تحویل کتاب‌ به علی عربگری در تاریخ ۱۴۰۱/۱۲/۱۲</h5>
                    <button type="button" class="bg-transparent" style="border: none" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " style="color:black;">
                    <div class="d-flex flex-column w-10 align-items-center justify-content-around">
                        <p style="color: darkred;font-size: 1.8rem">
                            هشدار!
                        </p>
                        <p class="text-center">
                            آیا از حذف اطمینان دارید؟ <br> این عمل غیرقابل بازگشت خواهد بود.
                        </p>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex w-100 align-items-center justify-content-around">
                        <a href="" class="btn btn-success"> <i class="feather icon-check-circle"></i> بله </a>
                        <button href="" class="btn btn-danger" data-dismiss="modal" aria-label="Close"> <i class="feather icon-slash"></i> خیر </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @slot('script')

        <script>
            $('#bookTitle1').select2()
            function insertNewBook() {
                let counter = parseInt($('#bookCount').text());
                counter = counter + 1;
                $('#bookCount').text(counter)
                const div = document.createElement('div');
                div.classList.add('row')
                div.classList.add('w-100')
                div.classList.add('px-0')
                div.setAttribute("id","book"+counter);
                div.innerHTML = `
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookTitle`+counter+`">*انتخاب کتاب  : </label>
                                        <select name="boo[]" id="book`+counter+`"  class="form-control select2">
                                             @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="count`+counter+`">*تعداد :</label>
                                        <input type="number" id="count`+counter+`" class="form-control required" name="count[]" value="" placeholder="تعداد کتاب تحویلی" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="wareHouse`+counter+`">آیا از موجودی سایت کسر شود؟</label>
                                        <select name="minus_stock[]" id="wareHouse`+counter+`">
                                            <option value="0" selected>خیر</option>
                                            <option value="1">بله</option>
                                        </select>
                                    </div>
                                </div>
`;

                document.getElementById('bookContainer').appendChild(div);
                activeSelect(counter)
            }
            function activeSelect(id){
                $('#book'+id).select2();
            }
            function removeLastBook(){
                $('#bookContainer').children().last().remove();
            }
        </script>
    @endslot


@endcomponent
