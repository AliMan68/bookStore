
@component('admin.layouts.content')
    @slot('title')
        ایجاد دسترسی جدید
    @endslot
    @slot('headerTitle')
        ایجاد دسترسی جدید
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content">
            <div class="row w-100">
                <div class="col-12">
                    <!-- form start -->
                    <form class="form-horizontal" action="{{route('admin.permissions.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">نام دسترسی</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username1" name="title" placeholder="نام دسترسی را وارد کنید">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">توضیحات</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" name="description" placeholder="توضیحات را وارد کنید">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer w-100">
                            <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> ثبت دسترسی</button>
                            <a href="{{route('admin.permissions.index')}}" type="submit" class="btn btn-default float-left"><i class="fa fa-backwardaa"></i> لغو</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
            </div>
        </div>
    </div>


@endcomponent


