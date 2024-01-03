<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
//        $this->middleware('can:show-access-management')->only('index');
    }

    public function index()
    {
        $permissions = Permission::query();
        if ($parameter = request('search')){
            $permissions->where('title','like',"%{$parameter}%")->orWhere('description','like',"%{$parameter}%")->orWhere('id',"%{$parameter}%");
        }
        $permissions = $permissions->paginate(20);
        return view('admin.permissions.all',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title' => ['required', 'string', 'max:255','unique:permissions'],
            'description' => ['required', 'string', 'max:255'],
        ]);
       Permission::create([
            'title'=>$data['title'],
            'description'=>$data['description'],
        ]);

        return redirect(route('admin.permissions.index'))->with('success','دسترسی با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'description' => ['required', 'string', 'max:255'],
        ]));

        return redirect(route('admin.permissions.index'))->with('success','دسترسی با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->deleteOrFail();

        return redirect(route('admin.permissions.index'))->with('success','دسترسی با موفقیت حذف شد');
    }
}
