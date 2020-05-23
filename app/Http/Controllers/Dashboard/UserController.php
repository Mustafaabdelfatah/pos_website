<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Storage;

class UserController extends Controller
{

    public function __construct ()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::WhereRoleIs('admin')->where(function($q) use($request){
            return $q->when($request->search,function($query) use($request){
                return $query->where('first_name' , 'like' , '%' . $request->search . '%')
                ->orWhere('last_name','like','%' . $request->search . '%');
            });
        })->latest()->paginate(5);
        return view('dashboard.users.index',compact('users'));
    }
    public function create(User $user)
    {
        return view('dashboard.users.create',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|unique:users',
            'image'                 => 'image',
            'password'              => 'required|confirmed',
            'permissions'           => 'required|min:1'
        ]);

        $request_data = $request->except(['password','password_confirmation','permissions','image']);

        $request_data['password'] = bcrypt(request('password'));

        if($request->image){
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        $users = User::create($request_data);

        $users->attachRole('admin');

        $users->syncPermissions($request->permissions);

        session()->flash('success' , __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');

    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('dashboard.users.edit',compact('users'));
    }


    public function update(Request $request, $id)
    {
        $users = User::find($id);

        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => ['required',Rule::unique('users')->ignore($users->id)],
            'image'                 => 'image',
        ]);

        $request_data = $request->except(['permissions','image']);

        if($request->image){

            if($users->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/'. $users->image);
            }//end of inner if

            Image::make($request->image)->resize(300, null, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $users->update($request_data);

        $users->syncPermissions($request->permissions);

        session()->flash('success' , __('site.updated_successfully'));

        return redirect()->route('dashboard.users.index');
    }
    public function destroy(User $user)
    {

        if($user->image != 'default.png'){

            Storage::disk('public_uploads')->delete('/user_images/'. $user->image);

        }// end of if

        $user->delete();

        session()->flash('success' , __('site.deleted_successfully'));

        return redirect()->route('dashboard.users.index');
    }
}
