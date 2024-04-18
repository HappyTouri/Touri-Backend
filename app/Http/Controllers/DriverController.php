<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverPhoto;
use App\Models\CarPhoto;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use Illuminate\Support\Facades\File;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_by_country($countryID)
    {

        try {
            $data = Driver::with('city.country', 'transportation', 'driver_photos', 'car_photos')->whereHas('city', function ($query) use ($countryID) {
                $query->where('country_id', $countryID);
            })->get();
            // dd($data);
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }

        // return $data;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        $driver = new Driver([
            "name" => $request->name,
            "mobile" => $request->mobile,
            "car_model" => $request->car_model,
            "number_of_seats" => $request->number_of_seats,
            "driver_rate" => $request->driver_rate,
            "driver_price" => $request->driver_price,
            "note" => $request->note,
            "city_id" => $request->city_id,
            "transportation_id" => $request->transportation_id,
        ]);
        $driver->save();

        if ($request->hasFile("DriverPhoto")) {
            $files = $request->file("DriverPhoto");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['driver_id'] = $driver->id;
                $request['photo'] = $imageName;
                $file->move(\public_path("/DriverImages"), $imageName);
                DriverPhoto::create($request->all());
            }
        }

        if ($request->hasFile("CarPhoto")) {
            $files = $request->file("CarPhoto");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['driver_id'] = $driver->id;
                $request['photo'] = $imageName;
                $file->move(\public_path("/CarImages"), $imageName);
                CarPhoto::create($request->all());
            }
        }

        return $this->create_response(true, 'ok', $driver);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        try {
            $data = Driver::with('city.country', 'transportation', 'driver_photos', 'car_photos')->where('id', $driver->id)->first();
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $valid = $request->validated();

        try {

            $driver->update($valid);
            $data = Driver::find($driver->id);
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try {
            $data = Driver::with('car_photos', 'driver_photos')->findOrFail($driver->id);
            // dd($data->car_photos);
            foreach ($data->car_photos as $image) {
                if (File::exists("CarImages/" . $image->photo)) {

                    File::delete("CarImages/" . $image->photo);
                }
            }
            foreach ($data->driver_photos as $image) {
                if (File::exists("DriverImages/" . $image->photo)) {

                    File::delete("DriverImages/" . $image->photo);
                }
            }
            $driver->delete();
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
