<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationPhoto;
use App\Http\Requests\StoreConfirmationPhotoRequest;
use Illuminate\Support\Facades\File;

class ConfirmationPhotoController extends Controller
{

    public function store(StoreConfirmationPhotoRequest $request)
    {
        try {
            if ($request->hasFile("confirmation_photos")) {
                $files = $request->file("confirmation_photos");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['tour_detail_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/confirmation_photos"), $imageName);
                    ConfirmationPhoto::create($request->all());
                }
            }
            $data = ConfirmationPhoto::all()->where("tour_detail_id", $request->id);

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function destroy(ConfirmationPhoto $confirmationPhoto)
    {
        try {

            if (File::exists("confirmation_photos/" . $confirmationPhoto->photo)) {
                File::delete("confirmation_photos/" . $confirmationPhoto->photo);
            }
            $confirmationPhoto->delete();
            return $this->create_response(true, 'ok', $confirmationPhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
