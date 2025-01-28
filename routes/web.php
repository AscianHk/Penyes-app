<?php


use App\Http\Controllers\ApplicationController;
use App\Http\Middleware\EsAdmin;
use App\Models\Application;
use App\Models\crews;
use App\Models\roles;
use App\Models\User;
use App\Models\users_crews;
use Database\Seeders\CrewsSeeder;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('./Auth/login');
});

Route::post('/verifyAuth', function(Request $request){
    
})->middleware(EsAdmin::class);

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/deleteacc', function(){
    $id = optional(Auth::user())->id;
    DB::delete("DELETE FROM users WHERE id='$id'");
    DB::delete("DELETE FROM roles WHERE user_id='$id'");

    return redirect('/');
});

Route::get('/register', function(){
    Return view('./Auth/register');
});


Route::get('/crews', function(){
    return view('crews')
    ->with('crews', crews::all());
});

Route::get('/crews/{id}', function($id){
    $crew = crews::findOrFail($id);
    return view('crew')->with('crews', $crew); 
});

Route::middleware('auth')->group(function() {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/applications/{id}', [ApplicationController::class, 'updateStatus'])->name('applications.update');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
});




Route::get('/UserPanel', function(){
    return view('./Panels/userPanel')
    ->with('crews', crews::all());
});

Route::get('/AdminPanel', function(){
    return view('./Panels/AdminPanel');
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

Route::post('/createcrew', function(Request $request){
    $crew = new crews();

    $crew->name= $request->input('name');
    $crew->color= $request->input('color');
    $crew->slogan= $request->input('slogan');
    $crew->capacity= $request->input('capacity');
    $crew->foundation_date = $request->input('foundation_date');
    
    $crew->save();

    return redirect('./Panels/AdminPanel');
});


Route::get('/draws', function(){
    return view('draw');

});


// Route::get('/pruebas', function(){
    
// }

// Route::get('/dashboard', function () {
    // return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


