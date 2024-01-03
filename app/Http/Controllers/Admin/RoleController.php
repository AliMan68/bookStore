<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::query();
        if ($parameter = request('search')){
            $role->where('title','like',"%{$parameter}%")->orWhere('description','like',"%{$parameter}%")->orWhere('id',"%{$parameter}%");
        }
        $roles = $role->paginate(20);
        return view('admin.roles.all',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' =>['required', 'string', 'max:255','unique:roles'],
            'description' =>['required', 'string', 'max:255'],
            'permissions' =>['required', 'array']
        ]);
        $role = Role::create([
            'title'=>$data['title'],
            'description'=>$data['description']
        ]);

        //Add permissions to this role
        $role->permissions()->sync($data['permissions']);
        return redirect(route('admin.roles.index'))->with('success','نفش با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'title' =>['required', 'string', 'max:255',\Illuminate\Validation\Rule::unique('roles')->ignore($role->id)],
            'description' =>['required', 'string', 'max:255'],
            'permissions' =>['required', 'array']
        ]);
        $role->update($data);
        $role->permissions()->sync($data['permissions']);
        return redirect(route('admin.roles.index'))->with('success','نفش با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->deleteOrFail();

        return redirect(route('admin.roles.index'))->with('success','نفش با موفقیت حذف شد');
    }
}
