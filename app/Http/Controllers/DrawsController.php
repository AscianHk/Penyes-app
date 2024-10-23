<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredrawsRequest;
use App\Http\Requests\UpdatedrawsRequest;
use App\Models\draws;

class DrawsController extends Controller
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
    public function store(StoredrawsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(draws $draws)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(draws $draws)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedrawsRequest $request, draws $draws)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(draws $draws)
    {
        //
    }
}
