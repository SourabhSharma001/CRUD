<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\UserDetail;

class UserController extends Controller
{
     public function index(){
        $users = UserDetail::all();
        return view('users.index', compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(\Illuminate\Http\Request $request){
        UserDetail::create($request->all());
        return redirect('/users');
    }

    public function edit($id){
        $user = UserDetail::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(\Illuminate\Http\Request $request, $id){
        $user = UserDetail::find($id);
        $user->update($request->all());
        return redirect('/users');
    }

    public function delete($id){
        UserDetail::find($id)->delete();
        return redirect('/users');
    }

    // public function home($name){
    //     $name = "Sourabh";
    //     return view('user', ["name" => $name]);
    // }
}
