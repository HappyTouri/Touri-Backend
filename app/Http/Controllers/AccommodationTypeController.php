<?php

namespace App\Http\Controllers;

use App\Models\AccommodationType;
use App\Http\Requests\StoreAccommodationTypeRequest;
use App\Http\Requests\UpdateAccommodationTypeRequest;

class AccommodationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = AccommodationType::get();
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
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
    public function store(StoreAccommodationTypeRequest $request)
    {
        try {
            $input = $request->all();
            $data = AccommodationType::create($input);
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(AccommodationType $accommodationType)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationType $accommodationType)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccommodationTypeRequest $request, AccommodationType $accommodationType)
    {
        try {
            $data = $request->validated();
            $accommodationType->update($data);
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationType $accommodation_type)
    {
        try {
            $data = $accommodation_type->delete();
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, $e->getMessage(), 404);
        }
    }
}
