<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::orderBy('id', 'desc')->paginate(6);
        return view('roles.all', ['roles' => $roles]);
    }
    public function create(Request $request){
        return view('roles.create');
    }

    public function store(Request $request){
        $data = $this->validate($request, [
            'name'=> 'string|required|min:2',
            'display_name'=> 'string|required|min:5',
            'description'=> 'string',
        ]);
        Role::create($data);
        return redirect(route('get-roles'));
    }

    public function destroy($id){
        dd(Role::find($id));
        Role::find($id)->delete();
        return redirect(route('get-roles'));
    }
}
