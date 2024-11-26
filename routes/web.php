<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EsAdmin;
use App\Models\roles;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/verifyAuth', function(Request $request){
    
})->middleware(EsAdmin::class);

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});

Route::get('/register', function(){
    Return view('register');
});
Route::get('/UserPanel', function(){
    return view('/userPanel');
});

Route::get('/AdminPanel', function(){
    return view('AdminPanel');
});


Route::post('/register', function(Request $request){
    $user =  new User();
    $role = new roles();
    
    // $user->id = uniqid();
    $user->name = $request->input('name');
    $user->surname = $request->input('surname');
    $user->email = $request->input('email');
    $user->birthday_date = $request->input('birth_date');
    $user->password = Hash::make($request->input('password'));
    $user->roles_id = $role->id;
    $user->save();


    
    $role->isAdmin;
    $role->user_id = $user->id;
    $role->save();

    return redirect('/');
});

// Route::get('/dashboard', function () {
    // return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


