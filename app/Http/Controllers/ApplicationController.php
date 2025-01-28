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
            return redirect('/');
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
            return back()->with('error', 'Ya tienes una solicitud pendiente para esta peña.');
        }

        $application = Application::create([
            'user_id' => $userId,
            'crews_id' => $request->crews_id,
            'status' => 'pending',
        ]);

        return redirect()->route('applications.index')->with('success', 'Solicitud enviada con éxito.');
    }


    
    public function updateStatus($id, Request $request)
    {
        $user = Auth::user();
        $application = Application::findOrFail($id);
    
        if ($user && $user->role && !$user->role->isAdmin) {
            return redirect()->route('applications.index')->with('error', 'No tienes permisos para realizar esta acción.');
        }
    
        if ($request->status == 'accepted') {
            Users_Crews::create([
                'user_id' => $application->user_id,
                'crews_id' => $application->crews_id,
                'year' => now()->format('Y-m-d'),
            ]);
    
            $application->status = 'accepted';
            $application->save();
    
            return redirect()->route('applications.index')
                ->with('success', 'Solicitud aceptada y usuario agregado a la crew');
        } else {
            $application->status = 'denied';
            $application->save();
    
            return redirect()->route('applications.index')
                ->with('error', 'Solicitud denegada');
        }
    }
    
    



public function index()
{
 
    $applications = Application::with(['user', 'crews'])
        ->where('status', 'pending')  
        ->get();
        $crews = crews::all();

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

    $application->status = 'accepted';
    $application->save();

    return response()->json(['message' => 'Solicitud aceptada y usuario agregado a la crew']);
}





}
