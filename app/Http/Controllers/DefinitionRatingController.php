<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDefinitionRatingRequest;
use App\Http\Requests\UpdateDefinitionRatingRequest;
use App\Models\DefinitionRating;

class DefinitionRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|staff|user');
    }
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
    public function store(StoreDefinitionRatingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DefinitionRating $definitionRatings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DefinitionRating $definitionRatings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefinitionRatingRequest $request, DefinitionRating $definitionRatings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefinitionRating $definitionRatings)
    {
        //
    }
}
