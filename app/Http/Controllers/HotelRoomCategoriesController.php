<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\RoomCategory;
use App\Models\HotelRoomCategories;
use App\Http\Requests\StoreHotelRoomCategoriesRequest;
use App\Http\Requests\UpdateHotelRoomCategoriesRequest;

class HotelRoomCategoriesController extends Controller
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
    public function store(StoreHotelRoomCategoriesRequest $request)
    {
        try {
            $input = $request->all();

            $accommodationId = $input['accommodation_id'] ?? null;
            $roomCategoryIds = $input['room_category_id'] ?? null;

            // Get the existing room category IDs for the specified accommodation
            $existingRoomCategoryIds = HotelRoomCategories::where('accommodation_id', $accommodationId)
                ->pluck('room_category_id')
                ->toArray();

            // Find the room category IDs to be deleted
            $categoriesToDelete = array_diff($existingRoomCategoryIds, $roomCategoryIds);

            // Delete room categories that are not present in the request
            if (!empty ($categoriesToDelete)) {
                HotelRoomCategories::where('accommodation_id', $accommodationId)
                    ->whereIn('room_category_id', $categoriesToDelete)
                    ->delete();
            }

            // Insert new room categories that are not present in the database
            $categoriesToInsert = array_diff($roomCategoryIds, $existingRoomCategoryIds);
            foreach ($categoriesToInsert as $categoryId) {
                $data = new HotelRoomCategories();
                $data->accommodation_id = $accommodationId;
                $data->room_category_id = $categoryId;
                $data->save();
            }

            // Retrieve the updated list of room categories for the accommodation
            $accommodation = Accommodation::with('hotel_room_categories')->find($accommodationId);

            return $this->create_response(true, 'ok', $accommodation);

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
    public function show(HotelRoomCategories $hotelRoomCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotelRoomCategories $hotelRoomCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRoomCategoriesRequest $request, HotelRoomCategories $hotelRoomCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelRoomCategories $hotelRoomCategories)
    {
        //
    }
}
