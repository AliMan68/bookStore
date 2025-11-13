@component('admin.layouts.content',['title'=>'ویرایش کتاب'])

    @slot('title')
        ویرایش کتاب {{$book->title}}
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
            <form class="form new-book" method="post" action="{{route('admin.books.update',$book->id)}}"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div style="direction: rtl"  class="row p-1 py-3">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="bookTitle">*نام کتاب :</label>
                            <input type="text" id="bookTitle" class="form-control required" name="title" value="{{$book->title}}" placeholder="نام کامل" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookCount">*تعداد موجودی :</label>
                            <input type="number" id="bookCount" class="form-control required" name="count" value="{{$book->count}}" placeholder="عدد وارد نمایید" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPic">*تصویر کتاب(جهت نمایش عمومی) :</label>
                            <input type="file" id="bookPic" class="form-control " name="image" >
                            @if(strlen($book->image) > 1)
                                <img src="{{asset($book->image)}}" style="width: 60px;height: 80px;border-radius: 3px;border: 1px darkblue solid" alt="{{$book->title}}">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPrice">*قیمت(تومان) :</label>
                            <input type="text" id="bookPrice" class="form-control required number-divider" name="price"  value="{{number_format($book->price)}}" placeholder="عدد وارد نمایید" required>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookSection">*دسته‌بندی‌(های)کتاب : </label>
                            <select name="categories[]" id="bookSection"  class="form-control select2" multiple>

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(in_array($category->id,$book->categories->pluck('id')->toArray())) selected @endif>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookWriter">*نویسنده‌(های)کتاب : </label>
                            <select name="authors[]" id="bookWriter"  class="form-control " multiple="">
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}" @if(in_array($author->id,$book->authors->pluck('id')->toArray())) selected @endif>{{$author->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookTranslator">مترجم(های)کتاب : </label>
                            <select name="translators[]" id="bookTranslator" class="form-control" multiple="">

                                @foreach($translators as $translator)
                                    <option value="{{$translator->id}}" @if(in_array($translator->id,$book->translators->pluck('id')->toArray())) selected @endif>{{$translator->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookCover">جلد :</label>
                            <input type="text" id="bookCover" class="form-control " name="cover"  value="{{$book->cover}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookOff">*درصد تخفیف :</label>
                            <input type="number" id="bookOff" class="form-control " name="discount_percent"  value="{{$book->discount_percent}}" placeholder="عدد وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookPages">*تعداد صفحات :</label>
                            <input type="number" id="bookPages" class="form-control required" required name="page_count"  value="{{$book->page_count}}" placeholder="عدد وارد نمایید" >
                        </div>
                    </div>
                    <div class="divider"></div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookEditor">ویراستار :</label>
                            <input type="text" id="bookEditor" class="form-control " name="editor"  value="{{$book->editor}}" placeholder="نام کامل را وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookISBN">شابک :</label>
                            <input type="text" id="bookISBN" class="form-control " name="isbn"  value="{{$book->isbn}}" placeholder="شابک را وارد نمایید" >
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bookDoc">فایل صفحاتی از کتاب :</label>
                            <input type="file" id="bookDoc" class="form-control " name="attachment" >
                            @if(strlen($book->attachment) > 1)
                                <a href="{{asset($book->attachment)}}" download="">دریافت</a>
                            @endif
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookNum">شمارگان-تیتراژ :</label>
                            <input type="text" id="bookNum" class="form-control " name="published"  value="{{$book->published}}" placeholder="اختیاری" >
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="book_year">سال چاپ :</label>
                            <select name="book_year" id="book_year" class="form-control">
                                <option value="1384" @if($book->book_year == 1384) selected @endif>1384</option>
                                <option value="1385" @if($book->book_year == 1385) selected @endif>1385</option>
                                <option value="1386" @if($book->book_year == 1386) selected @endif>1386</option>
                                <option value="1387" @if($book->book_year == 1387) selected @endif>1387</option>
                                <option value="1389" @if($book->book_year == 1389) selected @endif>1389</option>
                                <option value="1390" @if($book->book_year == 1390) selected @endif>1390</option>
                                <option value="1391" @if($book->book_year == 1391) selected @endif>1391</option>
                                <option value="1392" @if($book->book_year == 1392) selected @endif>1392</option>
                                <option value="1393" @if($book->book_year == 1393) selected @endif>1393</option>
                                <option value="1394" @if($book->book_year == 1394) selected @endif>1394</option>
                                <option value="1395" @if($book->book_year == 1395) selected @endif>1395</option>
                                <option value="1396" @if($book->book_year == 1396) selected @endif>1396</option>
                                <option value="1397" @if($book->book_year == 1397) selected @endif>1397</option>
                                <option value="1398" @if($book->book_year == 1398) selected @endif>1398</option>
                                <option value="1399" @if($book->book_year == 1399) selected @endif>1399</option>
                                <option value="1400" @if($book->book_year == 1400) selected @endif>1400</option>
                                <option value="1401" @if($book->book_year == 1401) selected @endif>1401</option>
                                <option value="1402" @if($book->book_year == 1402) selected @endif>1402</option>
                                <option value="1403" @if($book->book_year == 1403) selected @endif>1403</option>
                                <option value="1404" @if($book->book_year == 1404) selected @endif>1404</option>
                                <option value="1405" @if($book->book_year == 1405) selected @endif>1405</option>
                                <option value="1406" @if($book->book_year == 1406) selected @endif>1406</option>
                                <option value="1407" @if($book->book_year == 1407) selected @endif>1407</option>
                                <option value="1408" @if($book->book_year == 1408) selected @endif>1408</option>
                                <option value="1409" @if($book->book_year == 1409) selected @endif>1409</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookTurn">نوبت چاپ :</label>
                            <select name="credits" id="bookTurn" class="form-control">
                                <option value="اول" @if($book->credits == "اول") selected @endif>اول</option>
                                <option value="دوم" @if($book->credits == "دوم") selected @endif>دوم</option>
                                <option value="سوم" @if($book->credits == "سوم") selected @endif>سوم</option>
                                <option value="چهار" @if($book->credits == "چهار") selected @endif>چهار</option>
                                <option value="پنجم" @if($book->credits == "پنجم") selected @endif>پنجم</option>
                                <option value="ششم" @if($book->credits == "ششم") selected @endif>ششم</option>
                                <option value="هفتم" @if($book->credits == "هفتم") selected @endif>هفتم</option>
                                <option value="هشتم" @if($book->credits == "هشتم") selected @endif>هشتم</option>
                                <option value="نهم" @if($book->credits == "نهم") selected @endif>نهم</option>
                                <option value="دهم" @if($book->credits == "دهم") selected @endif>دهم</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookFrost">فروست انتشار :</label>
                            <input type="text" id="bookFrost" class="form-control " name="publication_frost"  value="{{$book->publication_frost}}" placeholder="اختیاری" >
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="bookCut"> قطع :</label>
                            <input type="text" id="bookCut" class="form-control " name="cut"  value="{{$book->cut}}" placeholder="اختیاری" >
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-12">
                        <div class="form-group">
                            <label for="bookInfo">*درباره کتاب:</label>
                            <textarea type="text" id="bookInfo" rows="5" class="form-control " name="about"   placeholder="حداقل در ۱۰ کلمه" required>{{$book->about}}</textarea>
                        </div>
                    </div>
                    <div class="divider"></div>

                    <div class="col-md-3 m-auto col-sm-12">
                        <div class="form-group">
                            <button href="" class="btn btn-warning" id="" style="min-width: 150px;border-radius: 15px"  type="submit">
                                <i class="feather icon-edit"></i>ویرایش کتاب
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endcomponent
