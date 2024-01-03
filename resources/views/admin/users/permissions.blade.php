@component('admin.layouts.content')
    @slot('title')
        ویرایش دسترسی‌ها کاربر : {{$user->name}}
    @endslot
    @slot('headerTitle')
        ویرایش دسترسی‌ها کاربر :  {{$user->name}}
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

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{route('admin.users.permissions.store',$user->id)}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="roles" class="col-sm-2 control-label">نقش‌ها</label>
                                    <div class="col-sm-10">
                                        <select type="text" class="form-control" id="roles" name="roles[]" multiple>
                                            @foreach(\App\Models\Role::all() as $role)
                                                @if($user->roles != null)
                                                    <option value="{{$role->id}}" {{in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : ''}}>{{$role->title}} - {{$role->description}}</option>
                                                @else
                                                    <option value="{{$role->id}}">{{$role->title}} - {{$role->description}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="permissions" class="col-sm-2 control-label">دسترسی‌ها</label>
                                    <div class="col-sm-10">
                                        <select type="text" class="form-control " id="permissions" name="permissions[]" multiple>
                                            @foreach(\App\Models\Permission::all() as $permission)

                                                @if($user->permissions != null)
                                                    <option value="{{$permission->id}}" {{in_array($permission->id,$user->permissions->pluck('id')->toArray()) ? 'selected' : ''}} >{{$permission->title}} - {{$permission->description}}</option>
                                                @else
                                                    <option value="{{$permission->id}}">{{$permission->title}} - {{$permission->description}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> ثبت دسترسی ها</button>
                                <a href="{{route('admin.roles.index')}}" type="submit" class="btn btn-default float-left"><i class="fa fa-backwardaa"></i> لغو</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>

                    </div>
                </div>
                @slot('script')
                    <script>
                        $('#roles').select2();
                        $('#permissions').select2();
                    </script>
                @endslot
            </div>
        </div>
    </div>
@endcomponent


