<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\crews;
use App\Models\Location;
use App\Models\locations;
use Illuminate\Http\Request;


class DrawsController extends Controller
{

    const MAX_HEIGHT = 5;
    const MAX_WIDTH = 5;

    // Show the Draw View for a spesific year
    public function show($year = null)
    {
        $currentYear = now()->year;
        if(is_null($year)){
            $year = $currentYear;
        }

        

        $crews = crews::all();


        $locations = locations::where('year', $year)->with('crew')->get();
        $showDrawButton = true;

        if ($locations->count() > 0) {
            $showDrawButton = false;
        }
        $rangeYears = range($currentYear-4, $currentYear);
        rsort($rangeYears);

        return view('draw', [
            'locations' => $locations,
            'year' => $year ?? now()->year,
            'showDrawButton' => $showDrawButton,
            'rangeYears' => $rangeYears,
            'crews' => $crews 
        ]);
    }





    // Perform the draw process and assign locations to crews
    public function draw(Request $request)
    {

        // dd('Entré en el método draw');
        $year = $request->year ?? now()->year;
        $crews = crews::all()->pluck('name', 'id');
        $locations = locations::where('year', $year)->get();


        if (count($crews) === 0) {
            return back()->withErrors('No hay peñas disponibles para este año.');
        }

        $places = [];
        $nCrews = count($crews);

        // Assign random valid coordinates to each crew
        foreach($crews as $crewId => $crewName){
            $isValidCoord = false;
            while(!$isValidCoord){
                $x = rand(0, (self::MAX_WIDTH-1));
                $y = rand(0, (self::MAX_HEIGHT-1));
                $coord = [$x, $y];
                $isValidCoord = $this->isValidCoord($coord, $places);
                if($isValidCoord){
                    $places[$crewId] = $coord;
                }
            }    
        }
       

        $locations = [];
        foreach ($places as $crewId => $coord) {
            $locations[] = [
                'x' => $coord[0], //x
                'y' => $coord[1], //y
                'crews_id' => $crewId, // Avoid assigning crew_id if it's "No Crew"
                'year' => $year
            ];
        }
        //Save locations in DB
        foreach ($locations as $location) {
            locations::create($location); 
        }


        return redirect()->route('draw.show', ['year' => $year]);
    }



    private function isValidCoord($coord, $places)
    {
        $isValidCoord = true;
        list($x, $y) = $coord;
        if(in_array($coord, $places)){
            $isValidCoord = false;
        }
        return $isValidCoord;
    }
}