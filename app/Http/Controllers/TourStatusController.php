<?php

namespace App\Http\Controllers;

use App\Models\TourStatus;
use App\Http\Requests\StoreTourStatusRequest;
use App\Http\Requests\UpdateTourStatusRequest;

class TourStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = TourStatus::get();
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
    public function store(StoreTourStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TourStatus $tourStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourStatus $tourStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourStatusRequest $request, TourStatus $tourStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourStatus $tourStatus)
    {
        //
    }
}
