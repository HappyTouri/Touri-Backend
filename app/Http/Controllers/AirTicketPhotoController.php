<?php

namespace App\Http\Controllers;

use App\Models\AirTicketPhoto;
use App\Http\Requests\StoreAirTicketPhotoRequest;
use App\Http\Requests\UpdateAirTicketPhotoRequest;
use Illuminate\Support\Facades\File;

class AirTicketPhotoController extends Controller
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
    public function store(StoreAirTicketPhotoRequest $request)
    {
        try {
            if ($request->hasFile("air_tickets")) {
                $files = $request->file("air_tickets");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['offer_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/air_tickets"), $imageName);
                    AirTicketPhoto::create($request->all());
                }
            }
            $data = AirTicketPhoto::all()->where("offer_id", $request->id);

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
    public function show(AirTicketPhoto $airTicketPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AirTicketPhoto $airTicketPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAirTicketPhotoRequest $request, AirTicketPhoto $airTicketPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AirTicketPhoto $airTicketPhoto)
    {
        try {

            if (File::exists("air_tickets/" . $airTicketPhoto->photo)) {
                File::delete("air_tickets/" . $airTicketPhoto->photo);
            }
            $airTicketPhoto->delete();
            return $this->create_response(true, 'ok', $airTicketPhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
