@component('admin.layouts.content')
    @slot('title')
        ویرایش نقش
    @endslot
    @slot('headerTitle')
        ویرایش نقش
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
                        <h3 class="card-title">ویرایش اطلاعات {{$role->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{route('admin.roles.update',$role->id)}}" method="post">

                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">عنوان </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username1" name="title" value="{{old('title',$role->title)}}" placeholder="عنوان را وارد کنید">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label" >توضیحات</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" name="description" value="{{old('description',$role->description)}}" placeholder="توضیجات را وارد کنید">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permissions" class="col-sm-4 control-label">دسترسی‌ها</label>
                                <div class="col-sm-10">
                                    <select type="text" class="form-control" id="permissions" name="permissions[]" multiple>
                                        @foreach(\App\Models\Permission::all() as $permission)
                                            <option value="{{$permission->id}}" {{in_array($permission->id,$role->permissions->pluck('id')->toArray()) ? 'selected' : ''}}>{{$permission->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">ویرایش نقش</button>
                            <a href="{{route('admin.roles.index')}}" type="submit" class="btn btn-default float-left">لغو</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
            </div>

            @slot('script')
                <script>
                    $('#permissions').select2({
                        'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
                    });
                </script>
            @endslot
        </div>
    </div>


@endcomponent


