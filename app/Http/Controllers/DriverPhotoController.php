<?php

namespace App\Http\Controllers;

use App\Models\DriverPhoto;
use App\Http\Requests\StoreDriverPhotoRequest;
use App\Http\Requests\UpdateDriverPhotoRequest;
use Illuminate\Support\Facades\File;

class DriverPhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverPhotoRequest $request)
    {
        try {

            // Retrieve existing driver photos for the given driver_id
            $existingPhotos = DriverPhoto::where('driver_id', $request->driver_id)->get();


            // Delete existing driver photos
            foreach ($existingPhotos as $existingPhoto) {
                if (File::exists("DriverImages/" . $existingPhoto->photo)) {
                    File::delete("DriverImages/" . $existingPhoto->photo);
                }
                $existingPhoto->delete();
            }

            // Store new driver photos
            if ($request->hasFile("DriverPhoto")) {
                $files = $request->file("DriverPhoto");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['driver_id'] = $request->driver_id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/DriverImages"), $imageName);
                    DriverPhoto::create($request->all());
                }
            }

            $data = DriverPhoto::where("driver_id", $request->driver_id)->get();

            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
    public function destroy(DriverPhoto $driverPhoto)
    {
        try {
            $image = DriverPhoto::findOrFail($driverPhoto->id);
            if (File::exists("DriverImages/" . $image->photo)) {
                File::delete("DriverImages/" . $image->photo);
            }

            $driverPhoto->delete();


            return $this->create_response(true, 'ok', $image);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }

    }
}
