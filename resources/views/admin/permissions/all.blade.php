@component('admin.layouts.content')
    @slot('title')
            مدیریت دسترسی‌ها
    @endslot
    @slot('headerTitle')
        مدیریت دسترسی‌ها
    @endslot
    <div class="card p-2" style="text-align: right;direction: rtl">
        <div class="card-content table-responsive d-block">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div class="row w-100">
                    <div class="col-12 table-responsive ">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <form action="" method="get">
                                    <div class="input-group input-group-sm m-1 my-2" style="width: 250px;border: 1px solid lightgray;border-radius: 6px;">
                                        <input type="text" name="search" value="{{request('search')}}" class="form-control float-right " style="border: none;font-size: 11px" placeholder="عنوان دسترسی">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @can('create-permission')
                                <a href="{{route('admin.permissions.create')}}" class="btn btn-sm btn-outline-success mb-2" style="font-size: 10px"><i class="feather icon-plus-circle"></i> ایجاد دسترسی جدید</a>
                            @endcan
                        </div>
                        <table class="w-100 table table-striped">
                            <thead>
                            <tr style="font-size: 10px">
                                <td>#</td>
                                <td>نام دسترسی</td>
                                <td>توضیح</td>
                                <td>تاریخ ایجاد</td>
                                <td>عملیات</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)

                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$permission->title}}</td>
                                    <td style="font-size: 11px">{{$permission->description}}</td>
                                    <td>{{jdate($permission->created_at)->format('%d %B %Y')}}</td>
                                    <td>
                                        <div class="d-flex w-100 justify-content-around">
                                            @can('edit-permission')
                                                <a href="{{route('admin.permissions.edit',$permission->id)}}" class="btn btn-sm btn-warning ">ویرایش</a>
                                            @endcan
                                            @can('delete-permission')
                                                <form action="{{route('admin.permissions.destroy',$permission->id)}}" method="post">
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
                            {{$permissions->render('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endcomponent


