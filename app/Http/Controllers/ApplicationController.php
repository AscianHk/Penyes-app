<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\crews;
use App\Models\users_crews;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;

use function Illuminate\Log\log;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
    
        $request->validate([
            'crews_id' => 'required|exists:crews,id',
        ]);
    
        $userId = Auth::id(); 

        $existingApplication = Application::where('user_id', $userId)
                                           ->where('crews_id', $request->crews_id)
                                           ->where('status', 'pending')
                                           ->first();
    
        if ($existingApplication) {
            return response()->json(['message' => 'Ya tienes una solicitud pendiente para esta crew.'], 400);
        }
    
        // Crear la solicitud
        $application = Application::create([
            'user_id' => $userId,
            'crews_id' => $request->crews_id,  
            'status' => 'pending',
        ]);
    
        return response()->json(['message' => 'Solicitud enviada correctamente.']);
    }
    
    public function updateStatus($id, Request $request)
    {
        $user = Auth::user();
    
        $application = Application::findOrFail($id); 
   
        if ($user && $user->role && $user->role->isAdmin == false) {
            return response()->json(['message' => 'No tienes permisos para realizar esta acción.'], 403);
        }
    
   
        if ($request->status == 'accepted') {
          
            users_crews::create([
                'user_id' => $application->user_id,  
                'crews_id' => $application->crews_id,  
                'year' => now()->year, 
            ]);
    
        
            $application->status = 'accepted';
            $application->save();
        } else {
       
            $application->status = 'denied';
            $application->save();
        }
    
        return response()->json(['message' => 'Solicitud procesada correctamente.']);
    }
    



public function index()
{
 
    $applications = Application::with(['user', 'crews'])
        ->where('status', 'pending')  
        ->get();
        $crews = Crews::all();

    return view('Applications', compact('applications',  'crews'));
}

public function accept(Request $request, $applicationId)
{
    $application = Application::find($applicationId);

    if (!$application) {
        return response()->json(['message' => 'Solicitud no encontrada'], 404);
    }

    if ($request->status == 'accepted') {
        users_crews::create([
            'user_id' => $application->user_id,
            'crews_id' => $application->crews_id,
            'year' => now()->year,
        ]);
    }

    // Cambiar el estado de la solicitud
    $application->status = 'accepted';
    $application->save();

    return response()->json(['message' => 'Solicitud aceptada y usuario agregado a la crew']);
}





}
