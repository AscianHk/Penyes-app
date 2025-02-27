<?php

use App\Http\Controllers\DrawsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CrewsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EsAdmin;
use App\Mail\ContactForm;
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
use Illuminate\Support\Facades\Mail;

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


Route::post('/deletedraw', function(){
    DB::delete("DELETE FROM locations WHERE year=2025");
    return redirect('/draw');
});

Route::get('/UserPanel', function(){
    return view('./Panels/userPanel')
    ->with('crews', crews::all())
    ->with('userscrews', users_crews::all())
    ->with('user', User::all());
});

Route::get('/AdminPanel', function () {
    $users = User::with('crews')->get();
    $crews = crews::all();

    return view('./Panels/AdminPanel', compact('users', 'crews'));
});

Route::post('/register', function(Request $request) {
    try {
        $user = new User();
        $role = new roles();
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->birthday_date = $request->input('birth_date');
        $user->password = Hash::make($request->input('password'));
        $user->roles_id = $role->id;
        
        $user->save();
        
        $role->isAdmin = false; // Set false by default for new users
        $role->user_id = $user->id;
        $role->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado correctamente'
            ]);
        }

        return redirect('/')->with('success', 'Usuario creado correctamente');
    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario: ' . $e->getMessage()
            ], 500);
        }
        
        return back()->with('error', 'Error al crear el usuario');
    }
});

Route::post('/createcrew', function(Request $request){
    $crew = new crews();

    $crew->name= $request->input('name');
    $crew->color= $request->input('color');
    $crew->slogan= $request->input('slogan');
    $crew->capacity= $request->input('capacity');
    $crew->foundation_date = $request->input('foundation_date');
    
    $crew->save();

    return redirect('/AdminPanel');
});

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/crews/{id}/edit', [CrewsController::class, 'edit'])->name('crews.edit'); // Ruta para editar
Route::patch('/crews/{id}', [CrewsController::class, 'update'])->name('crews.update');
Route::delete('/crews/{id}', [CrewsController::class, 'destroy'])->name('crews.destroy'); // Ruta para eliminar


Route::get('/draw/{year?}', [DrawsController::class, 'show'])->name('draw.show');
Route::post('/draw', [DrawsController::class, 'draw'])->name('draw.draw');

// Route::get('/draw', function () {
//     return view('draw');
// })->middleware('auth');



Route::post('/contact', function (Request $request) {
    try {
        Mail::to('admin@example.com')->send(new ContactForm($request->all()));
        
        return response()->json([
            'success' => true,
            'message' => 'Mensaje enviado correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al enviar el mensaje: ' . $e->getMessage()
        ], 500);
    }
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


