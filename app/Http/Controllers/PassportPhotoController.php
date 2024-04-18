<?php

namespace App\Http\Controllers;

use App\Models\PassportPhoto;
use App\Http\Requests\StorePassportPhotoRequest;
use App\Http\Requests\UpdatePassportPhotoRequest;
use Illuminate\Support\Facades\File;


class PassportPhotoController extends Controller
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
    public function store(StorePassportPhotoRequest $request)
    {
        try {
            if ($request->hasFile("passports")) {
                $files = $request->file("passports");
                foreach ($files as $file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $request['offer_id'] = $request->id;
                    $request['photo'] = $imageName;
                    $file->move(\public_path("/passports"), $imageName);
                    PassportPhoto::create($request->all());
                }
            }
            $data = PassportPhoto::all()->where("offer_id", $request->id);

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
    public function show(PassportPhoto $passportPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PassportPhoto $passportPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePassportPhotoRequest $request, PassportPhoto $passportPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PassportPhoto $passportPhoto)
    {
        try {

            if (File::exists("passports/" . $passportPhoto->photo)) {
                File::delete("passports/" . $passportPhoto->photo);
            }
            $passportPhoto->delete();
            return $this->create_response(true, 'ok', $passportPhoto);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
