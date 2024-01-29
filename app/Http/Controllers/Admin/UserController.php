<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function __construct()
    {
        $this->middleware('can:edit-user')->only('edit');
        $this->middleware('can:delete-user')->only('destroy');
        $this->middleware('can:manage-users')->only('index');

    }
    public function index()
    {
        $users = User::query();
        if ($parameter = request('search')){
            $users->where('email','like',"%{$parameter}%")->orWhere('name','like',"%{$parameter}%")->orWhere('id',"%{$parameter}%");
        }
        if (\request('is_admin')){
            $users->where('is_admin',1)->orWhere('is_staff',1);
        }
        $users = $users->paginate(20);
        return view('admin.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required','string','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/','unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['array'],
        ]);
//        dd($data['password']);


        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'is_staff'=>1,
            'password'=>Hash::make($data['password'])
        ]);
        if ($data['roles'] != null){
            $user->roles()->sync($data['roles']);
        }
        if ($request->has('verify')){
//            $user->email_verified_at = now();
            //this function verify email if user check verify checkbox
            $user->markEmailAsVerified();
        }
        return redirect(route('admin.users.index'))->with('success','کاربر با موقیت ذخیره شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

//        $user = User::where('id','=',$id)->get();
//        dd($user->name);



        //first way of using GATE by itself

//        if (Gate::allows('edit-user',$user)){
//            return view('admin.users.edit',compact('user'));
//        }
//        return abort(403);

        //second way of using authorization by authorize method inside controller parents
//        $this->authorize('edit-user',$user);
//        return view('admin.users.edit',compact('user'));


        //third way of using authorization
//        if (auth()->user()->can('edit-user',$user)){
//            return view('admin.users.edit',compact('user'))
//        }
            return view('admin.users.edit',compact('user'));

        return abort(403);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Rule::unique('users')->ignore($user->id)  -- ignore when user use it's email again
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if (!isNull($request->password)){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
        }
        if ($request->has('verify')){
            $user->markEmailAsVerified();
        }
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        return redirect(route('admin.users.index'))->with('success','کاربر با موقیت بروز شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();
        return redirect(route('admin.users.index'))->with('success','کاربر با موفقیت حذف شد.');
    }
}
