<?php

namespace App\Http\Controllers;

use App\Models\InvoicePhoto;
use App\Http\Requests\StoreInvoicePhotoRequest;
use Illuminate\Support\Facades\File;

class InvoicePhotoController extends Controller
{

    public function store(StoreInvoicePhotoRequest $request)
    {
        try {
            if ($request->hasFile("invoice_photos")) {
                $files = $request->file("invoice_photos");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['tour_detail_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/invoice_photos"), $imageName);
                    InvoicePhoto::create($request->all());
                }
            }
            $data = InvoicePhoto::all()->where("tour_detail_id", $request->id);

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy(InvoicePhoto $invoicePhoto)
    {
        try {

            if (File::exists("invoice_photos/" . $invoicePhoto->photo)) {
                File::delete("invoice_photos/" . $invoicePhoto->photo);
            }
            $invoicePhoto->delete();
            return $this->create_response(true, 'ok', $invoicePhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
