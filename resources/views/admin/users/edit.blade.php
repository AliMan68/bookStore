@component('admin.layouts.content')
    @slot('title')
        ویرایش کاربر {{$user->name}}
    @endslot
    @slot('headerTitle')
        ویرایش کاربر {{$user->name}}
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

                        <!-- form start -->
                        <form class="form-horizontal" action="{{route('admin.users.update',$user->id)}}" method="post">

                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">نام کاربر</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username1" name="name" value="{{$user->name}}" placeholder="نام کاربر را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label" >ایمیل</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" name="email" value="{{$user->email}}" placeholder="ایمیل را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">پسورد</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="پسورد را وارد کنید">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-2 control-label">تکرار پسورد</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password_confirmation" id="inputPassword4" placeholder="تکرار پسورد را وارد کنید">
                                    </div>
                                </div>
{{--                                @if(!$user->hasVerifiedEmail())--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="checkbox" class="col-sm-2 control-label">تایید ایمیل</label>--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <input type="checkbox" class="form-control" name="verify" id="checkbox" >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}





                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">ویرایش کاربر</button>
                                <a href="{{route('admin.users.index')}}" type="submit" class="btn btn-default float-left">لغو</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent


