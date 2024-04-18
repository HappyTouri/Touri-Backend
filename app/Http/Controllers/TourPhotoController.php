<?php

namespace App\Http\Controllers;

use App\Models\TourPhoto;
use App\Http\Requests\StoreTourPhotoRequest;
use App\Http\Requests\UpdateTourPhotoRequest;
use Illuminate\Support\Facades\File;

class TourPhotoController extends Controller
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
    public function store(StoreTourPhotoRequest $request)
    {
        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['tour_id'] = $request->tour_id;
                $request['photo'] = $imageName;
                $file->move(\public_path("/TourImages"), $imageName);
                TourPhoto::create($request->all());
            }
        }
        $data = TourPhoto::all()->where("tour_id", $request->tour_id);

        return $this->create_response(true, 'ok', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(TourPhoto $tourPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourPhoto $tourPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourPhotoRequest $request, TourPhoto $tourPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourPhoto $tourPhoto)
    {
        try {
            $image = TourPhoto::findOrFail($tourPhoto->id);
            if (File::exists("TourImages/" . $image->photo)) {
                File::delete("TourImages/" . $image->photo);
            }

            $tourPhoto->delete();


            return $this->create_response(true, 'ok', $image);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
