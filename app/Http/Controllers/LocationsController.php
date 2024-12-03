<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorelocationsRequest;
use App\Http\Requests\UpdatelocationsRequest;
use App\Models\locations;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelocationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(locations $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(locations $locations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelocationsRequest $request, locations $locations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(locations $locations)
    {
        //
    }
}
