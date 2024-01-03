@component('admin.layouts.content',['title'=>'ثبت کتاب جدید'])

    @slot('title')
        ثبت کتاب جدید
    @endslot
    <ul style="direction: rtl" class="mb-0">
        <li>
            <p class="text-right text-black-50">درج اطلاعات آیتم‌های ستاره دار اجباری می‌باشد</p>
        </li>
    </ul>

    @if(\Illuminate\Support\Facades\Session::get('fail'))
        <h6 class=" m-auto alert alert-danger"> {{\Illuminate\Support\Facades\Session::get('fail')}}</h6>

    @endif
    @if(\Illuminate\Support\Facades\Session::get('success'))
        <h6 class="text-white mt-1 messageStyle left-zero" id="messageNavigation">
            <span>  {{\Illuminate\Support\Facades\Session::get('success')}}<i class="feather icon-check-circle" style="color: white"></i></span>
        </h6>
    @endif
    <div class="card" style="text-align: right;">
        <div class="card-content px-2">
            <form class="form new-book" method="post" action="{{route('admin.books.store')}}"  enctype="multipart/form-data">
                @csrf
                <div style="direction: rtl"  class="row p-1 py-3">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="bookTitle">*نام کتاب :</label>
                            <input type="text" id="bookTitle" class="form-control required" name="title" value="{{old('title')}}" placeholder="نام کامل" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookCount">*تعداد موجودی :</label>
                            <input type="number" id="bookCount" class="form-control required  number-divider" name="count"   value="{{old('count')}}" placeholder="عدد وارد نمایید" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPic">*تصویر کتاب(جهت نمایش عمومی) :</label>
                            <input type="file" id="bookPic" class="form-control " name="image" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPrice">*قیمت(تومان) :</label>
                            <input type="text" id="bookPrice" class="form-control required number-divider" name="price"  value="{{old('price')}}" placeholder="عدد وارد نمایید" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookSection">*دسته‌بندی‌(های)کتاب : </label>
                            <select name="categories[]" id="bookSection"  class="form-control select2" multiple>

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookWriter">*نویسنده‌(های)کتاب : </label>
                            <select name="authors[]" id="bookWriter"  class="form-control " multiple="">
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{$author->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookTranslator">مترجم(های)کتاب : </label>
                            <select name="translators[]" id="bookTranslator" class="form-control" multiple="">

                                @foreach($translators as $translator)
                                    <option value="{{$translator->id}}">{{$translator->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookCover">جلد :</label>
                            <input type="text" id="bookCover" class="form-control " name="cover"  value="{{old('cover')}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookOff">*درصد تخفیف :</label>
                            <input type="number" id="bookOff" class="form-control " name="discount_percent"  value="{{old('discount_percent')}}" placeholder="عدد وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPages">*تعداد صفحات :</label>
                            <input type="number" id="bookPages" class="form-control required" required name="page_count"  value="{{old('page_count')}}" placeholder="عدد وارد نمایید" >
                        </div>
                    </div>
                    <div class="divider"></div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookEditor">ویراستار :</label>
                            <input type="text" id="bookEditor" class="form-control " name="editor"  value="{{old('editor')}}" placeholder="نام کامل را وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookISBN">شابک :</label>
                            <input type="text" id="bookISBN" class="form-control " name="isbn"  value="{{old('isbn')}}" placeholder="شابک را وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookDoc">فایل صفحاتی از کتاب :</label>
                            <input type="file" id="bookDoc" class="form-control " name="attachment" >
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookNum">شمارگان-تیتراژ :</label>
                            <input type="text" id="bookNum" class="form-control " name="published"  value="{{old('published')}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookTurn">نوبت چاپ :</label>
                            <input type="text" id="bookTurn" class="form-control " name="credits"  value="{{old('credits')}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookFrost">فروست انتشار :</label>
                            <input type="text" id="bookFrost" class="form-control " name="publication_frost"  value="{{old('publication_frost')}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookCut"> قطع :</label>
                            <input type="text" id="bookCut" class="form-control " name="cut"  value="{{old('cut')}}" placeholder="اختیاری" >
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <label for="bookInfo">*درباره کتاب:</label>
                            <textarea type="text" id="bookInfo" rows="5" class="form-control " name="about"   placeholder="حداقل در ۱۰ کلمه" required></textarea>
                        </div>
                    </div>
                    <div class="divider"></div>

                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-plus-circle"></i>ثبت کتاب
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endcomponent
