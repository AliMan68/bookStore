

@component('admin.layouts.content')
    @slot('title')
        ایجاد نقش جدید
    @endslot
    @slot('headerTitle')
        ایجاد نقش جدید
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content">
            <div class="row w-100">
                <div class="col-12 table-responsive ">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card-header">
                        <h3 class="card-title">دسترسی جدید</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{route('admin.roles.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">نام نقش‌</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username1" name="title" placeholder="نام نقش‌ را وارد کنید" value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" name="description" placeholder="توضیحات را وارد کنید" {{old('description')}}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permissions" class="col-sm-2 control-label">دسترسی‌ها</label>
                                <div class="col-sm-10">
                                    <select type="text" class="form-control" id="permissions" name="permissions[]" multiple>
                                        @foreach(\App\Models\Permission::all() as $permissions)
                                            <option value="{{$permissions->id}}">{{$permissions->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> ثبت نقش‌</button>
                            <a href="{{route('admin.roles.index')}}" type="submit" class="btn btn-default float-left"><i class="fa fa-backwardaa"></i> لغو</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
            </div>
            @slot('script')
                <script>

                    $('#permissions').select2();
                </script>
            @endslot
        </div>
    </div>


@endcomponent


