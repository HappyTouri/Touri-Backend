<?php

namespace App\Http\Controllers;

use App\Models\TourHeader;
use App\Http\Requests\StoreTourHeaderRequest;
use App\Http\Requests\UpdateTourHeaderRequest;

class TourHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = TourHeader::all();
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }



    public function store(StoreTourHeaderRequest $request)
    {
        try {
            $input = $request->all();
            $data = TourHeader::create($input);
            return $this->create_response(true, 'ok', $data, 201);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TourHeader $tourHeader)
    {
        try {
            $data = $tourHeader;

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }


    public function update(UpdateTourHeaderRequest $request, TourHeader $tourHeader)
    {
        try {
            $data = $request->validated();
            $tourHeader->update($data);
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourHeader $tourHeader)
    {
        try {
            $data = $tourHeader->delete();
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
