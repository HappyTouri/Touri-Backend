<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationPhoto;
use App\Models\ApartmentDetail;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }


    public function index_by_country($countryID)
    {


        try {
            $data = Accommodation::with(
                'apartment_details',
                'city.country',
                'apartment_details',
                'accommodation_photos',
                'hotel_seasons',
                'accommodation_type',
                'apartment_season_prices',
                'hotel_seasons',
                'hotel_room_categories.hotelPrices.hotel_season',
                'hotel_room_categories.room_category',

            )->whereHas('city', function ($query) use ($countryID) {
                $query->where('country_id', $countryID);
            })->get();

            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }


    }


    public function share(Request $request, $id)
    {

        // return $request->share;
        try {
            $data = $request->share;
            $accommodation = Accommodation::findOrFail($id);
            $accommodation->update([
                'share' => $data,
            ]);

            return $this->create_response(true, 'ok', $accommodation);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccommodationRequest $request)
    {
        try {
            if ($request->hasFile("cover_photo")) {
                $files = $request->file("cover_photo");
                foreach ($files as $file) {
                    $imageCover = time() . '_' . $file->getClientOriginalName();
                    $file->move(\public_path("HotelCover/"), $imageCover);
                }

                if ($request->hasFile("price_list_PDF")) {
                    $files = $request->file("price_list_PDF");
                    foreach ($files as $file) {
                        $imagePriceList = time() . '_' . $file->getClientOriginalName();
                        $file->move(\public_path("PriceList/"), $imagePriceList);
                    }
                }

                $data = new Accommodation([
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'email' => $request->email,
                    'price_list_PDF' => "$imagePriceList",
                    'share' => 0,
                    'note' => $request->note,
                    'cover_photo' => $imageCover,
                    'video_link' => $request->video_link,
                    'city_id' => $request->city_id,
                    'accommodation_type_id' => $request->accommodation_type_id,
                    'hotel_website' => $request->hotel_website

                ]);

                $data->save();

                if ($request->accommodation_type_id !== "1") {
                    $apartment = new ApartmentDetail([
                        'accommodation_id' => $data->id,
                        'number_of_rooms' => $request->number_of_rooms,
                        'number_of_peoples' => $request->number_of_peoples,
                    ]);
                    // $apartment->save();
                    $data->apartment_details()->save($apartment);
                }

                if ($request->hasFile("images")) {
                    $files = $request->file("images");
                    foreach ($files as $file) {
                        $imageName = time() . '_' . $file->getClientOriginalName();
                        $request['accommodation_id'] = $data->id;
                        $request['photo'] = $imageName;
                        $file->move(\public_path("/HotelPhotos"), $imageName);
                        AccommodationPhoto::create($request->all());
                    }
                }

            }



            return $this->create_response(true, 'ok', $request);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        try {
            $data = Accommodation::with(
                'city.country',
                'accommodation_photos',
                'hotel_seasons',
                'accommodation_type',
                'apartment_season_prices',
                'hotel_seasons.hotel_prices',
                'apartment_details',
                'hotel_room_categories.room_category'
            )
                ->findOrFail($accommodation->id);
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }


    public function updateAccommodation(UpdateAccommodationRequest $request, $id)
    {
        try {

            $accommodation = Accommodation::findOrFail($id);

            if ($request->hasFile("cover_photo")) {
                $files = $request->file("cover_photo");
                foreach ($files as $file) {
                    $imageCover = time() . '_' . $file->getClientOriginalName();
                    $file->move(\public_path("HotelCover/"), $imageCover);
                }
            } else {
                $imageCover = $request->cover_photo;
            }

            if ($request->hasFile("price_list_PDF")) {
                $files = $request->file("price_list_PDF");
                foreach ($files as $file) {
                    $imagePriceList = time() . '_' . $file->getClientOriginalName();
                    $file->move(\public_path("PriceList/"), $imagePriceList);
                }
            } else {
                $imagePriceList = $request->price_list_PDF;
            }

            $accommodation->update([
                'name' => $request->name,
                'rate' => $request->rate,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'email' => $request->email,
                'price_list_PDF' => "$imagePriceList",
                'note' => $request->note,
                'cover_photo' => $imageCover,
                'video_link' => $request->video_link,
                'city_id' => $request->city_id,
                'accommodation_type_id' => $request->accommodation_type_id,
                'hotel_website' => $request->hotel_website
            ]);


            if ($request->accommodation_type_id !== "1") {
                $apartment = $accommodation->apartment_details()->firstOrNew([]);
                $apartment->number_of_rooms = $request->number_of_rooms;
                $apartment->number_of_peoples = $request->number_of_peoples;
                $apartment->save();
            }

            return $this->create_response(true, 'ok', $accommodation);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        try {
            $accommodation = Accommodation::findOrFail($accommodation->id);
            if (File::exists("HotelCover/" . $accommodation->cover_photo)) {
                File::delete("HotelCover/" . $accommodation->cover_photo);
            }

            if (File::exists("PriceList/" . $accommodation->price_list_PDF)) {
                File::delete("PriceList/" . $accommodation->price_list_PDF);
            }

            $images = AccommodationPhoto::where("accommodation_id", $accommodation->id)->get();
            foreach ($images as $image) {
                if (File::exists("HotelPhotos/" . $image->photo)) {
                    File::delete("HotelPhotos/" . $image->photo);
                }
            }

            $accommodation->delete();
            return $this->create_response(true, 'ok', $accommodation);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
