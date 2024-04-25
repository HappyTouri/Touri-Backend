<?php

namespace App\Http\Controllers;

use App\Models\PaymentPhoto;
use App\Http\Requests\StorePaymentPhotoRequest;
use Illuminate\Support\Facades\File;

class PaymentPhotoController extends Controller
{
    public function store(StorePaymentPhotoRequest $request)
    {
        try {
            if ($request->hasFile("payment_photos")) {
                $files = $request->file("payment_photos");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['tour_detail_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/payment_photos"), $imageName);
                    PaymentPhoto::create($request->all());
                }
            }
            $data = PaymentPhoto::all()->where("tour_detail_id", $request->id);

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function destroy(PaymentPhoto $paymentPhoto)
    {
        try {
            if (File::exists("payment_photos/" . $paymentPhoto->photo)) {
                File::delete("payment_photos/" . $paymentPhoto->photo);
            }
            $paymentPhoto->delete();
            return $this->create_response(true, 'ok', $paymentPhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
