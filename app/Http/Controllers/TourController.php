<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourPhoto;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function index_by_country($countryID)
    {
        try {
            // $data = Tour::with('tour_photos')->with('city.country')->get();
            $data = Tour::with('tour_photos')->with('city.country')->whereHas('city', function ($query) use ($countryID) {
                $query->where('country_id', $countryID);
            })->get();

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
    public function store(StoreTourRequest $request)
    {

        $tour = new Tour([
            "tour_title_EN" => $request->tour_title_EN,
            "tour_title_AR" => $request->tour_title_AR,
            "tour_title_RU" => $request->tour_title_RU,
            "tour_title_local" => $request->tour_title_local,
            "tour_description_EN" => $request->tour_description_EN,
            "tour_description_AR" => $request->tour_description_AR,
            "tour_description_RU" => $request->tour_description_RU,
            "tour_description_local" => $request->tour_description_local,
            "video_link" => $request->video_link,
            "city_id" => $request->city_id,
        ]);
        $tour->save();

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                // $imageName = env('APP_URL') . '/TourImages' . '/' . time() . '_' . $file->getClientOriginalName();
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['tour_id'] = $tour->id;
                $request['photo'] = $imageName;
                $file->move(\public_path("/TourImages"), $imageName);
                TourPhoto::create($request->all());
            }
        }

        return $this->create_response(true, 'ok', $tour);

    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {

        try {
            $data = Tour::with('tour_photos')->with('city.country')->findOrFail($tour->id);

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        $tour = Tour::findOrFail($tour->id);

        $tour->update([
            "tour_title_EN" => $request->input("tour_title_EN"),
            "tour_title_AR" => $request->input("tour_title_AR"),
            "tour_title_RU" => $request->input("tour_title_RU"),
            "tour_title_local" => $request->input("tour_title_local"),
            "tour_description_EN" => $request->input("tour_description_EN"),
            "tour_description_AR" => $request->input("tour_description_AR"),
            "tour_description_RU" => $request->input("tour_description_RU"),
            "tour_description_local" => $request->input("tour_description_local"),
            "video_link" => $request->input("video_link"),
            "city_id" => $request->input("city_id"),
        ]);


        return $request;


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {

        try {
            $tour = Tour::findOrFail($tour->id);
            $images = TourPhoto::where("tour_id", $tour->id)->get();
            foreach ($images as $image) {
                if (File::exists("TourImages/" . $image->photo)) {

                    File::delete("TourImages/" . $image->photo);
                }
            }
            $tour->delete();
            return $this->create_response(true, 'ok', $images);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }

    }
}
