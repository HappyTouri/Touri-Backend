<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\HotelPrice;
use App\Models\HotelSeason;
use App\Http\Requests\StoreHotelPriceRequest;
use App\Http\Requests\UpdateHotelPriceRequest;

class HotelPriceController extends Controller
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
    public function store(StoreHotelPriceRequest $request)
    {
        try {
            $input = $request->all();
            $accommodationId = $input['accommodation_id'] ?? null;
            $hotelSeasons = $input['season_prices'] ?? [];

            // Delete existing prices associated with the existing seasons
            HotelPrice::whereIn('hotel_season_id', function ($query) use ($accommodationId) {
                $query->select('id')
                    ->from('hotel_seasons')
                    ->where('accommodation_id', $accommodationId);
            })->delete();

            // Delete existing seasons for the accommodation
            HotelSeason::where('accommodation_id', $accommodationId)->delete();

            // Create new seasons and prices
            foreach ($hotelSeasons as $seasonData) {
                $season = $this->createSeason($accommodationId, $seasonData);
                $this->createPrices($season->id, $seasonData['RoomsCategory']);
            }

            return $this->create_response(true, 'ok', $hotelSeasons);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    private function createSeason($accommodationId, $data)
    {
        $season = new HotelSeason();
        $season->accommodation_id = $accommodationId;
        $season->from = Carbon::parse($data['from'])->toDateString();
        $season->till = Carbon::parse($data['till'])->toDateString();
        $season->extrabed_price = $data['extraBed'] ?? null;
        $season->save();

        return $season;
    }

    private function createPrices($seasonId, $roomCategories)
    {
        foreach ($roomCategories as $roomCategoryData) {
            $roomPrice = new HotelPrice();
            $roomPrice->hotel_season_id = $seasonId;
            $roomPrice->hotel_room_categories_id = $roomCategoryData['id'];
            $roomPrice->price = $roomCategoryData['Price'];
            $roomPrice->save();
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(HotelPrice $hotelPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotelPrice $hotelPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelPriceRequest $request, HotelPrice $hotelPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelPrice $hotelPrice)
    {
        //
    }
}
