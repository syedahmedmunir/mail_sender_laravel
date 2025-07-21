<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UsersController extends Controller
{
    
    public function index(){

        $data['users'] = User::get();

        return view('user.index',$data);
    }

    public function create(){

        
        return view('user.create');


    }

    public function store(Request $request){

        DB::beginTransaction();

        $request->validate([
            'name'          => 'required',
            'password'      => 'required',
            'role_id'       => 'required',
            'email'         => 'required|unique:users,email'

        ]);

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        DB::commit();

        return redirect()->route('user.index')->with('success','User Created Successfully');

    }

    public function edit($id){


        $data['user'] = User::find($id);


        return view('user.edit',$data);


    }

    public function update(Request $request,$id){

        DB::beginTransaction();

        $user = User::find($id);

        $request->validate([
            'name'          => 'required',
            'role_id'       => 'required',
            'email'         => 'required|unique:users,email,'.$user->id

        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;

        if(!empty($user->password)){
            $user->password = bcrypt($request->password);
        }

        $user->update();

        $role = Role::find($request->role_id);
        $role->syncPermissions($role->permissions);

        $assign_role = $user->assignRole($role);

        DB::commit();

        return redirect()->route('user.index')->with('success','User Updated Successfully');
    }

    public function delete($id){

        DB::beginTransaction();

        $user = User::where('id',$id)->delete();

        DB::commit();

        return redirect()->route('user.index')->with('success','User Deleted Successfully');

    }

}
