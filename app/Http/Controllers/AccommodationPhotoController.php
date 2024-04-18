<?php

namespace App\Http\Controllers;

use App\Models\AccommodationPhoto;
use App\Http\Requests\StoreAccommodationPhotoRequest;
use App\Http\Requests\UpdateAccommodationPhotoRequest;
use Illuminate\Support\Facades\File;

class AccommodationPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(StoreAccommodationPhotoRequest $request)
    {
        try {
            if ($request->hasFile("images")) {
                $files = $request->file("images");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['accommodation_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/HotelPhotos"), $imageName);
                    AccommodationPhoto::create($request->all());
                }
            }
            $data = AccommodationPhoto::all()->where("accommodation_id", $request->id);

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
    public function show(AccommodationPhoto $accommodationPhoto)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationPhoto $accommodationPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccommodationPhotoRequest $request, AccommodationPhoto $accommodationPhoto)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationPhoto $accommodationPhoto)
    {
        try {

            if (File::exists("HotelPhotos/" . $accommodationPhoto->photo)) {
                File::delete("HotelPhotos/" . $accommodationPhoto->photo);
            }
            $accommodationPhoto->delete();
            return $this->create_response(true, 'ok', $accommodationPhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
