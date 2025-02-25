<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecrewsRequest;
use App\Http\Requests\UpdatecrewsRequest;
use App\Models\crews;
use Illuminate\Http\Request;

class CrewsController extends Controller
{
    public function edit($id)
    {
        $crew = crews::find($id);

        if (!$crew) {
            return redirect()->back()->with('error', 'Peña no encontrada.');
        }

        return view('edit', compact('crew')); // Asegúrate de que esta vista exista
    }

    public function update(Request $request, $id)
{
    try {
        $crew = crews::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1'
        ]);

        $crew->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peña actualizada correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar la peña: ' . $e->getMessage()
        ], 500);
    }
}

    public function destroy($id)
    {
        $crew = crews::find($id);

        if (!$crew) {
            return redirect()->back()->with('error', 'Peña no encontrada.');
        }

        $crew->delete();

        return redirect()->back()->with('success', 'Peña eliminada correctamente.');
    }
}
