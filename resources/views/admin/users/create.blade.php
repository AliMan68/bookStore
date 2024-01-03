
@component('admin.layouts.content')
    @slot('title')
        ایجاد کاربر جدید
    @endslot
    @slot('headerTitle')
        ایجاد کاربر جدید
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <div class="d-flex flex-row align-items-center justify-content-between">
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
                            <h3 class="card-title">کاربر جدید</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{route('admin.users.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">*نام کاربر</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required id="username1" name="name" placeholder="نام کاربر را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail5" class="col-sm-2 control-label">*شماره همراه</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required id="inputEmail5" name="phone" placeholder="شماره همراه را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">*ایمیل</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" required id="inputEmail3" name="email" placeholder="ایمیل را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">*پسورد</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" required id="inputPassword3" name="password" placeholder="پسورد را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-2 control-label">تکرار پسورد</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" required name="password_confirmation" id="inputPassword4" placeholder="تکرار پسورد را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roles" class="col-sm-2 control-label">*نقش‌</label>
                                    <div class="col-sm-10">
                                        <select type="text" class="form-control" id="roles" name="roles[]" required multiple>
                                            @foreach(\App\Models\Role::all() as $role)
                                                <option value="{{$role->id}}">{{$role->title}} - {{$role->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="checkbox" class="col-sm-2 control-label">تایید ایمیل</label>--}}
{{--                                    <div class="col-sm-2">--}}
{{--                                        <input type="checkbox" class="form-control" name="verify" id="checkbox" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">ثبت</button>
                                <a href="{{route('admin.users.index')}}" type="submit" class="btn btn-default float-left">لغو</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @slot('script')
        <script>
            $('#roles').select2();
            $('#permissions').select2();
        </script>
    @endslot


@endcomponent


