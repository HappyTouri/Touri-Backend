<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Offer;
use App\Models\TourDetail;
use App\Models\RRoomCategory;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmalMailable;
use App\Mail\CancelMailable;




use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    public function index_by_country($countryID)
    {
        $user = Auth::user();
        try {
            $data = Offer::with(
                'tour_details.r_room_categories',
                'country',
                'transportation',
                'tour_header',
            )->where('country_id', $countryID)->get();
            if ($user) {
                if ($user->role == "admin") {
                    foreach ($data as $offer) {
                        $offer->refresh();
                        $offer['admin_seen_at'] = Carbon::now();
                        $offer->save();
                    }
                }
                if ($user->role == "tour operator") {
                    foreach ($data as $offer) {
                        $offer->refresh();
                        $offer['operator_seen_at'] = Carbon::now();
                        $offer->save();
                    }
                }
            }
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }

    }



    public function store(StoreOfferRequest $request)
    {
        try {
            $offer = new Offer([
                "operator_id" => $request->operator_id,
                "country_id" => $request->country_id,
                "website_share" => $request->website_share,
                "tour_title" => $request->tour_name,
                "tour_header_id" => $request->tour_title,
                "transportation_id" => $request->transportation_id,
                "from" => Carbon::parse($request->from),
                "till" => Carbon::parse($request->till),
                "number_of_days" => $request->number_of_days,
                "transportation_price" => $request->transportation_price,
                "tour_guide_price" => $request->tourguide_price,
                "hotels_price" => $request->hotels_price,
                "profit_price" => $request->profit_price,
                "tour_price" => $request->total_price,
            ]);
            $offer->save();

            $tourDetails = $request->tourDetails;

            foreach ($tourDetails as $tourDetailData) {
                $tourDetail = new TourDetail([
                    'offer_id' => $offer->id,
                    'date' => Carbon::parse($tourDetailData['date']),
                    'tour_id' => $tourDetailData['tour_id'],
                    'tourguide' => $tourDetailData['tourguide'] ?? 0,
                    'accommodation_id' => $tourDetailData['accommodation_id'] ?? null,
                    'accommodation_price' => $tourDetailData['accommodation_price'],
                    'number_of_room' => $tourDetailData['number_of_rooms'] ?? 0,
                    'driver_id' => null
                ]);
                $tourDetail->save();

                $accommodationTypeId = $tourDetailData['accommodation_type_id'] ?? null;

                if ($accommodationTypeId == 1 && isset($tourDetailData['roomsCategories'])) {
                    $roomsCategories = $tourDetailData['roomsCategories'];
                    foreach ($roomsCategories as $roomCategoryData) {
                        $roomCategory = new RRoomCategory([
                            'tour_detail_id' => $tourDetail->id,
                            'room_category_id' => $roomCategoryData['room_category_id'],
                            'extra_bed' => $roomCategoryData['extrabed'],
                            'room_price' => $roomCategoryData['room_price'],
                            'extrabed_price' => $roomCategoryData['extrabed_price'],

                        ]);
                        $roomCategory->save();
                    }
                }

            }

            return $this->create_response(true, 'ok', $request->all());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function show(Offer $offer)
    {
        try {
            $data = Offer::with(
                'tour_details.r_room_categories.room_category.room_category',
                'tour_details.tour.tour_photos',
                'tour_details.tour.city',
                'tour_details.accommodation.city',
                'tour_details.accommodation.accommodation_type',
                'tour_details.confirmation',
                'tour_details.invoice',
                'tour_details.payment',
                'country',
                'transportation',
                'tour_header',
                'tour_header',
                'passports',
                'airtickets',
                'customer',


            )
                ->findOrFail($offer->id);
            return $this->create_response(true, 'ok', $data);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        try {
            // Update Offer attributes from the request
            $offer->update([
                // "operator_id" => $request->operator_id,
                "country_id" => $request->country_id,
                "website_share" => $request->website_share,
                "tour_title" => $request->tour_name,
                "tour_header_id" => $request->tour_title,
                "transportation_id" => $request->transportation_id,
                "from" => Carbon::parse($request->from),
                "till" => Carbon::parse($request->till),
                "number_of_days" => $request->number_of_days,
                "transportation_price" => $request->transportation_price,
                "tour_guide_price" => $request->tourguide_price,
                "hotels_price" => $request->hotels_price,
                "profit_price" => $request->profit_price,
                "tour_price" => $request->total_price,
            ]);

            $tourDetails = $request->tourDetails;

            // Delete existing tour details and room categories associated with this offer
            $offer->tour_details()->delete();

            foreach ($tourDetails as $tourDetailData) {
                $tourDetail = new TourDetail([
                    'offer_id' => $offer->id,
                    'date' => Carbon::parse($tourDetailData['date']),
                    'tour_id' => $tourDetailData['tour_id'],
                    'tourguide' => $tourDetailData['tourguide'] ?? 0,
                    'accommodation_id' => $tourDetailData['accommodation_id'] ?? null,
                    'accommodation_price' => $tourDetailData['accommodation_price'],
                    'number_of_room' => $tourDetailData['number_of_rooms'] ?? 0,
                ]);
                $offer->tour_details()->save($tourDetail);
                $accommodationTypeId = $tourDetailData['accommodation_type_id'] ?? null;
                // Check if accommodation type is 1 (assuming 1 means it's a type that includes room categories)
                if ($accommodationTypeId == 1 && isset($tourDetailData['roomsCategories'])) {
                    $roomsCategories = $tourDetailData['roomsCategories'];
                    foreach ($roomsCategories as $roomCategoryData) {
                        $roomCategory = new RRoomCategory([
                            'tour_detail_id' => $tourDetail->id,
                            'room_category_id' => $roomCategoryData['room_category_id'],
                            'extra_bed' => $roomCategoryData['extrabed'],
                            'room_price' => $roomCategoryData['room_price'],
                            'extrabed_price' => $roomCategoryData['extrabed_price'],
                        ]);
                        $tourDetail->r_room_categories()->save($roomCategory);
                    }
                }
            }

            // Return the updated offer data
            return $this->create_response(true, 'ok', $offer->load('tour_details.r_room_categories'));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }


    public function reserve(UpdateOfferRequest $request, $id)
    {
        try {
            $offer = Offer::findOrFail($id);

            $offer->update([
                // "operator_id" => $request->operator_id,
                "customer_id" => $request->customer_id,
                "number_of_people" => $request->number_of_people,
                "note" => $request->note,
                "reserved" => true
            ]);


            // return $request;
            return $this->create_response(true, 'ok', $offer);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function sendEmail(Request $request)
    {
        try {
            // Try sending the email

            Mail::to("tbilisitraveler@gmail.com")->send(new EmalMailable($request));


            // Fetch the tours using the correct query
            $tours = TourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('offer_id', $request->offer_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($tours as $item) {
                $item->status = "Email Sent"; // Update status to "Email Sent"
                $item->email_note = $request->email_note;
                $item->save();
            }
            return $request;
            // return response()->json(['message' => 'Email sent and note updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function cancelEmail(Request $request)
    {
        try {
            // Mail::to("tbilisitraveler@gmail.com")->send(new EmalMailable($request));
            // Fetch the tours using the correct query
            $tours = TourDetail::whereBetween('date', [$request->date, $request->till])
                ->where('accommodation_id', $request->accommodation_id)
                ->where('offer_id', $request->offer_id)
                ->get(); // Execute the query

            // Update each tour detail
            foreach ($tours as $item) {
                $item->status = "Canceled Email";
                $item->email_note = $request->email_note;
                $item->save();
            }
            // return $request;
            return response()->json(['message' => 'Email sent and note updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function confirmOrDone(Request $request, TourDetail $tourDetail)
    {
        try {
            if ($request->payment_price) {
                $tourDetail->update([
                    'status' => 'Done'
                ]);
            }
            if ($request->invoice_price) {
                $tourDetail->update([
                    'status' => 'Reserve Confirmed'
                ]);
            }
            return 'done';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        try {
            $data = $offer->delete();
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
