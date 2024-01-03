


@component('admin.layouts.content')
    @slot('title')
        ویرایش دسترسی
    @endslot
    @slot('headerTitle')
        ویرایش دسترسی
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content">
            <div class="row w-100">
                <div class="col-12">
                    <!-- form start -->
                    <form class="form-horizontal" action="{{route('admin.permissions.update',$permission->id)}}" method="post">

                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-6 control-label">عنوان دسترسی</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username1" name="title" value="{{old('title',$permission->title)}}" placeholder="عنوان را وارد کنید">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-6 control-label" >توضیحات</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" name="description" value="{{old('description',$permission->description)}}" placeholder="توضیجات را وارد کنید">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">ویرایش دسترسی</button>
                            <a href="{{route('admin.permissions.index')}}" type="submit" class="btn btn-default float-left">لغو</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
            </div>
        </div>
    </div>


@endcomponent


