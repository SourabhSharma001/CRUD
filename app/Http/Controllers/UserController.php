<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    

public function ajaxStore(Request $request)
{
    $user = UserDetail::create($request->only(
        'name','age','dob','address'
    ));

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'age' => $user->age,
        'dob' => Carbon::parse($user->dob)->format('d-m-Y'),
        'address' => $user->address
    ]);
}

public function ajaxUpdate(Request $request, $id)
{
    $user = UserDetail::findOrFail($id);
    $user->update($request->only(
        'name','age','dob','address'
    ));

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'age' => $user->age,
        'dob' => Carbon::parse($user->dob)->format('d-m-Y'),
        'address' => $user->address
    ]);
}

public function ajaxDelete($id)
{
    UserDetail::findOrFail($id)->delete();
    return response()->json(['success' => true]);
}

}
