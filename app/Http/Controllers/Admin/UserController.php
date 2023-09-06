<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Hash;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = 10;
        if($request->get('length'))
        $length = $request->get('length');
        $users = User::query();

        if($request->get('search'))
            $users->where('name','like','%'.$request->get('search').'%')
                ->where('email','like','%'.$request->get('search').'%');
                
        if($request->get('role'))
            $users->whereRoleIs([$request->get('role')]);

        $users = $users->paginate($length);
        return  view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();
        return  view('admin.users.save',compact('user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone' => 'nullable|digits:10',
            'password' => 'required|min:8|confirmed',
        ];
        if($request->id > 0 && empty($request->password))
        unset($fields['password']);

        $this->validate($request,$fields);
        if($request->id > 0){
           $user =  User::find($request->id);
           $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
           ]);
           if($request->get('password'))
           $user->update(['password' => Hash::make($request->password)]);

        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            if($request->role)
                $user->attachRole($request->role);
        }
        return redirect()->route('admin.users.index')->with('success','User saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $roles = Role::all();
        return  view('admin.users.save',compact('user','roles'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user){
            $user->delete();
        }
        return back()->with('success','User deleted successfully');
    }
}
