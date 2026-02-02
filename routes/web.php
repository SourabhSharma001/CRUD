<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\UserController;

use function Pest\Laravel\json;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::get('/users/delete/{id}', [UserController::class, 'delete']);
// Route::get('/home', [UserController::class, 'home']);
// Route::get('/ajax-test', function () 
// {
//     return response()->json((['message' => 'Hello AJAX! This came from server']));
// });

// Route::post('/ajax-add-user', function (\Illuminate\Http\Request $request) {

//     $user = \App\Models\UserDetail::create([
//         'name' => $request->name,
//         'age' => $request->age,
//         'dob' => $request->dob,
//         'address' => $request->address,
//     ]);

//     return response()->json([
//         'name' => $user->name,
//         'age' => $user->age,
//         'dob_formatted' => \Carbon\Carbon::parse($user->dob)->format('d-m-Y'),
//         'address' => $user->address
//     ]);
// });


Route::post('/ajax-add-user', [UserController::class, 'ajaxStore']);

Route::post('/ajax-delete-user/{id}', [UserController::class, 'ajaxDelete']);

Route::post('/ajax-update-user/{id}', [UserController::class, 'ajaxUpdate']);
