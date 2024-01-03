<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersPermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-user-permissions,user')->only('create');


    }

    public function create(User $user){

        return view('admin.users.permissions',compact('user'));
    }

    public function store(Request $request,User $user){
        $data = $request->validate([
            'roles'=>['array'],
            'permissions'=>['array']
        ]);

        //check if request contain any permission or role- after update relations base on it

        if ($request->roles != null)
            $user->roles()->sync($data['roles']);
        else
            $user->roles()->detach();
        if ($request->permissions != null)
            $user->permissions()->sync($data['permissions']);
        else
            $user->permissions()->detach();


        return redirect(route('admin.users.index'))->with('success',"دسترسی $user->name با موفقیت ویرایش شد");

    }

}
