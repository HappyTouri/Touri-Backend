<?php

namespace App\Http\Controllers;

use App\Models\TourguidePrice;
use App\Http\Requests\StoreTourguidePriceRequest;
use App\Http\Requests\UpdateTourguidePriceRequest;

class TourguidePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = TourguidePrice::with('country')->get();
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
    public function store(StoreTourguidePriceRequest $request)
    {
        try {
            $input = $request->all();
            $data = TourguidePrice::create($input);
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TourguidePrice $tourguidePrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourguidePrice $tourguidePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourguidePriceRequest $request, TourguidePrice $tourguidePrice)
    {
        try {
            $input = $request->all();
            $data = $tourguidePrice->update($input);
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourguidePrice $tourguidePrice)
    {
        try {
            $data = $tourguidePrice->delete();
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
