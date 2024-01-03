@component('admin.layouts.content')
    @slot('title')
        مدیریت نقش‌ها
    @endslot
    @slot('headerTitle')
        مدیریت نقش‌ها
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div class="row w-100">
                    <div class="col-12 table-responsive ">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <form action="">
                                <div class="input-group input-group-sm m-1 my-2" style="width: 250px;border: 1px solid lightgray;border-radius: 6px;">
                                    <input type="text" name="search" value="{{request('search')}}" class="form-control float-right " style="border: none;font-size: 11px" placeholder="عنوان نقش">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                @can('create-role')
                                    <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-outline-success mb-2">ایجاد نقش‌ جدید</a>
                                @endcan
                            </div>

                        </div>
                        <table class="w-100 table table-striped">
                            <thead>
                            <tr style="font-size: 10px">
                                <td>#</td>
                                <td>نام نقش</td>
                                <td>توضیحات</td>
{{--                                <td>دسترسی‌ها</td>--}}
                                <td>تاریخ ایجاد</td>
                                <td>عملیات</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$role->title}}</td>
                                    <td>{{$role->description}}</td>
{{--                                    <td>--}}
{{--                                        --}}{{--                            {{$role->permissions()->get()}}--}}
{{--                                        @foreach($role->permissions()->get() as $permission)--}}
{{--                                            {{$permission->title}}  ,--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}
                                    <td>{{jdate($role->created_at)->format('%d %B %Y')}}</td>
                                    <td>
                                        <div class="d-flex w-100 justify-content-around">

                                            @can('edit-role')
                                                <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-sm btn-warning ">ویرایش</a>
                                            @endcan
                                            @can('delete-role')
                                                <form action="{{route('admin.roles.destroy',$role->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">حذف</button>
                                                </form>
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
                            {{$roles->render('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endcomponent

