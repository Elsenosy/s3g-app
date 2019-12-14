<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('users.all', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $roles = \App\Role::all();
        
        if(!empty($request->all())){
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            
            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
            ]);
            // Get the role 
            $role = \App\Role::find($request->role);
            $user->attachRole($role);
            if($user){
                return redirect(route('all-users'));
            }
        }
        
        return view('users.create', ['roles' => $roles]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = \App\Role::all();
        return view('users.edit', ['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        

        $data = $this->validate($request, [
            'name' => 'string|required',
            'email'=> 'email|required',
            'role' => 'numeric',
        ]);

        // Find the role
        $role = \App\Role::find($request->role);
        if(!$user->hasRole($role->name)){
            // Detach all roles, only set one role.
            $user->roles()->detach();
            $user->attachRole($role);
        }

        // Save 
        if($user->save($data)){
            return redirect(route('all-users'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('all-users'));
    }
}
