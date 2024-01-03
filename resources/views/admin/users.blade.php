@component('admin.layouts.content')
    @slot('title')
        مدیریت کاربران
    @endslot
    @slot('headerTitle')
        مدیریت کاربران
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div class="row w-100">
                    <div class="col-12 table-responsive ">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <form action="">
                                    <div class="input-group input-group-sm m-1 my-2" style="width: 250px;border: 1px solid lightgray;border-radius: 6px;">
                                        <input type="text" name="search" value="{{request('search')}}" class="form-control float-right " style="border: none;font-size: 11px" placeholder="نام کاربر">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-outline-success mb-2">ایجاد کاربر جدید</a>
                            </div>
                        </div>
                        <table class="w-100 table table-striped">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>نام</td>
                                <td>نقش</td>
                                <td>ایمیل</td>
                                <td>شماره تماس</td>
                                <td>عملیات</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($users as $user)
                                @if($user->is_admin == 1)
                                    @continue
                                @endif
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @foreach($user->roles()->get() as $role)
                                            {{$role->title}}
                                        @endforeach
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        <div class="d-flex w-100 justify-content-around">
                                            @can('edit-user')
                                                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-sm btn-warning ">ویرایش</a>
                                            @endcan
                                            @can('delete-user')
                                                <form action="{{route('admin.users.destroy',$user->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-sm btn-danger mx-1">حذف</button>
                                                </form>
                                            @endcan
                                            @can('manage-user-permissions')
                                                    <a href="{{route('admin.users.permissions.create',$user->id)}}" class="btn btn-sm btn-success ">دسترسی‌ها</a>
                                            @endcan
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <div class="card-footer">
                            {{$users->appends(['search'=>request('search')])->render('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endcomponent


