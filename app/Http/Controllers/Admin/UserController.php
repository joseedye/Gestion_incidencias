<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role',1)->get();
        return view('admin.users.index')->with(compact('users'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $projects = project::all();
        $projects_user = ProjectUser::where('user_id',$user->id)->get();
        return view('admin.users.edit')->with(compact('user','projects','projects_user'));
    }

    public function storeUser(Request $request)
    {
        $rules=[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'], 
        ];

        $this->validate($request, $rules);

        $user = new User();
        $user->name =$request->input('name');
        $user->email = $request->input('email');
        $user->password =bcrypt($request->input('password'));
        $user->role=1;
        $user->save();
        
        return back()->with('notification','Usuario registrado exitosamente.');
    }

    public function updateUser($id,Request $request)
    {
        $rules=[
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable','min:8'], 
        ];

        $this->validate($request, $rules);

        $user = User::find($id);
        $user->name =$request->input('name');
        $password =bcrypt($request->input('password'));
        if($password)
            $user->password =bcrypt($password);
        
        $user->save();
        
        return back()->with('notification','Usuario modificado exitosamente.');
    }

    public function deleteUser($id){
        $user= User::find($id);
        $user->delete();
        return back()->with('notification','El usuario ha sido eliminado correctamente.');
    }
}
