<?php

namespace App\Http\Controllers;

use App\Models\TransportationPrice;
use App\Http\Requests\StoreTransportationPriceRequest;
use App\Http\Requests\UpdateTransportationPriceRequest;
use App\Models\Country;

class TransportationPriceController extends Controller
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
            $data = TransportationPrice::with('country')->with('transportation')->where('country_id', $countryID)->get();
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
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
    public function store(StoreTransportationPriceRequest $request)
    {
        try {
            $input = $request->all();
            $data = TransportationPrice::create($input);
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportationPrice $transportationPrice)
    {
        //
    }
    public function transportatinPriceByCountry($country)
    {

        $country = Country::where('country', $country)->first();


        $transportationPrice = TransportationPrice::with('country')->with('transportation')->where('country_id', '=', $country->id)
            ->get();


        return $this->create_response(true, 'ok', $transportationPrice, 200);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransportationPriceRequest $request, TransportationPrice $transportationPrice)
    {
        try {
            $input = $request->all();
            $data = $transportationPrice->update($input);
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportationPrice $transportationPrice)
    {
        try {
            $data = $transportationPrice->delete();
            return $this->create_response(true, 'ok', $data, 201);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }
}
