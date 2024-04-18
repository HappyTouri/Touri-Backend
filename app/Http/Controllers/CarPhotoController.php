<?php

namespace App\Http\Controllers;

use App\Models\CarPhoto;
use App\Http\Requests\StoreCarPhotoRequest;
use App\Http\Requests\UpdateCarPhotoRequest;
use Illuminate\Support\Facades\File;

class CarPhotoController extends Controller
{



    public function store(StoreCarPhotoRequest $request)
    {
        try {
            if ($request->hasFile("CarPhoto")) {
                $files = $request->file("CarPhoto");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['driver_id'] = $request->driver_id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/CarImages"), $imageName);
                    CarPhoto::create($request->all());
                }
            }
            $data = CarPhoto::all()->where("driver_id", $request->driver_id);

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }




    public function destroy(CarPhoto $carPhoto)
    {
        try {
            $image = CarPhoto::findOrFail($carPhoto->id);
            if (File::exists("CarImages/" . $image->photo)) {
                File::delete("CarImages/" . $image->photo);
            }

            $carPhoto->delete();


            return $this->create_response(true, 'ok', $image);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
