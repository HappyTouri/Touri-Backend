<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ApartmentSeasonPrice;
use App\Http\Requests\StoreApartmentSeasonPriceRequest;
use App\Http\Requests\UpdateApartmentSeasonPriceRequest;

class ApartmentSeasonPriceController extends Controller
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
    public function store(StoreApartmentSeasonPriceRequest $request)
    {
        try {
            $input = $request->all();
            $accommodationId = $input['accommodation_id'] ?? null;
            $ApartmentSeasons = $input['season_prices'] ?? [];


            // Delete existing seasons for the accommodation
            ApartmentSeasonPrice::where('accommodation_id', $accommodationId)->delete();

            // Create new seasons and prices
            foreach ($ApartmentSeasons as $seasonData) {
                $season = $this->createSeason($accommodationId, $seasonData);
            }

            return $this->create_response(true, 'ok', $ApartmentSeasons);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    private function createSeason($accommodationId, $data)
    {
        $season = new ApartmentSeasonPrice();
        $season->accommodation_id = $accommodationId;
        $season->from = Carbon::parse($data['from'])->toDateString();
        $season->till = Carbon::parse($data['till'])->toDateString();
        $season->season_price = $data['price'] ?? null;
        $season->save();

        return $season;
    }



    /**
     * Display the specified resource.
     */
    public function show(ApartmentSeasonPrice $apartmentSeasonPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApartmentSeasonPrice $apartmentSeasonPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentSeasonPriceRequest $request, ApartmentSeasonPrice $apartmentSeasonPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApartmentSeasonPrice $apartmentSeasonPrice)
    {
        //
    }
}
