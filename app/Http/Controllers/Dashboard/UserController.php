<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }
    public function index(Request $request)
    {
        $users= User::whereRoleIs('admin')->when($request->search,function ($query) use ($request) {
            return $query->where('name','like','%'. $request->search .'%');
        })->latest()->paginate(3);
        return view('dashboard.users.index',compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required' ,
            'email' => 'required' ,
            'password' => 'required|confirmed' ,
            'image' => 'image' ,
            'permissions' => 'required|min:1'
        ]);
        $request_data = $request->except(['password','password_confirmation','permissions','image']);
        $request_data['password'] = bcrypt($request->password);
        if($request->image){
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('/uploads/users/'.$request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        session()->flash('success',__('added_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    // public function show(User $user)
    // {
    //     //
    // }
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required' ,
            'email' => 'required' ,
            // 'password' => 'required|confirmed'
            'image' => 'image' ,
            'permissions' => 'required:min:1'
        ]);
        $request_data = $request->except(['permissions','image']);
        if($request->image){
            if($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('users/'.$user->image);
            }
            Image::make($request->image)->resize(300,null,function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('/uploads/users/'.$request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);

        $user->syncPermissions($request->permissions);
        session()->flash('success',__('updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('users/'.$user->image);
        }
        $user->delete();
        session()->flash('success',__('deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
