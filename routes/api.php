<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\AccommodationPhotoController;
use App\Http\Controllers\AccommodationTypeController;
use App\Http\Controllers\AirTicketPhotoController;
use App\Http\Controllers\ApartmentDetailController;
use App\Http\Controllers\ApartmentSeasonPriceController;
use App\Http\Controllers\CarPhotoController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ConfirmationPhotoController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HotelPriceController;
use App\Http\Controllers\HotelReservationController;
use App\Http\Controllers\HotelRoomCategoriesController;
use App\Http\Controllers\HotelSeasonController;
use App\Http\Controllers\InvoicePhotoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferSeenController;
use App\Http\Controllers\PassportPhotoController;
use App\Http\Controllers\PaymentPhotoController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\RRoomCategoryController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourDetailController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TourguidePriceController;
use App\Http\Controllers\TourPhotoController;
use App\Http\Controllers\TourStatusController;
use App\Http\Controllers\TourTitleController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\TransportationPriceController;
use App\Http\Controllers\DriverPhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourHeaderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
require_once __DIR__ . '/auth.php';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {

    // Countries
    route::apiResource('countries', CountryController::class);

    // Cities
    Route::prefix('cities')
        ->controller(CityController::class)
        ->group(function () {
            Route::get('/{id}', 'index_by_country');
        });
    route::apiResource('cities', CityController::class);

    // Transportation Types
    route::apiResource('transportations', TransportationController::class);

    // Accommodation Types
    route::apiResource('accommodation_types', AccommodationTypeController::class);

    // Transportation Prices
    Route::prefix('transportation_prices')
        ->controller(TransportationPriceController::class)
        ->group(function () {
            Route::get('/{id}', 'index_by_country');
        });
    route::apiResource('transportation_prices', TransportationPriceController::class);

    // Rooms Category
    route::apiResource('room_categories', RoomCategoryController::class);

    // Tour Titles
    route::apiResource('tour_titles', TourTitleController::class);

    // Tour Headers
    route::apiResource('tour-headers', TourHeaderController::class);

    //Tours
    Route::prefix('tours-by-country')
        ->controller(TourController::class)
        ->group(function () {
            Route::get('/{id}', 'index_by_country');
        });
    route::apiResource('tours', TourController::class);
    // Tours Photos
    route::apiResource('tour_photos', TourPhotoController::class);


    // Drivers
    route::apiResource('drivers', DriverController::class)->except('index');
    Route::prefix('drivers-by-country')
        ->controller(DriverController::class)
        ->group(function () {
            Route::get('/{countryID}', 'index_by_country');
        });
    // Car photos
    route::apiResource('car_photos', CarPhotoController::class);
    // Driver photos
    route::apiResource('driver_photo', DriverPhotoController::class);

    // Accommodation 
    Route::prefix('accommodation-by-country')
        ->controller(AccommodationController::class)
        ->group(function () {
            Route::get('/{id}', 'index_by_country');
        });
    Route::prefix('edit-accommodations')
        ->controller(AccommodationController::class)
        ->group(function () {
            Route::post('/{id}', 'updateAccommodation');
        });
    Route::prefix('share-accommodations')
        ->controller(AccommodationController::class)
        ->group(function () {
            Route::post('/{id}', 'share');
        });
    route::apiResource('accommodations', AccommodationController::class);

    route::apiResource('accommodation_photos', AccommodationPhotoController::class);

    // hotel room Categories
    route::apiResource('hotel_room_categories', HotelRoomCategoriesController::class);

    // Hotel Prices
    route::apiResource('hotel_prices', HotelPriceController::class);


    // Tour Status
    route::apiResource('tour_statuses', TourStatusController::class);

    // Tour Status
    route::apiResource('tourguide_price', TourguidePriceController::class);

    // Apartment Season Prices
    route::apiResource('apartment_season_prices', ApartmentSeasonPriceController::class);

    //Offers and Reservations
    Route::prefix('reserve')
        ->controller(OfferController::class)
        ->group(function () {
            Route::put('/{id}', 'reserve');
        });
    Route::prefix('all-offers')
        ->controller(OfferController::class)
        ->group(function () {
            Route::get('/{id}', 'index_by_country');
        });
    route::apiResource('offers', OfferController::class);
    route::apiResource('users', UserController::class);
    //passport photos
    route::apiResource('passport_photos', PassportPhotoController::class);
    //air tickets
    route::apiResource('air_ticket_photos', AirTicketPhotoController::class);


    //confirmation & invoice & payment  Photos
    route::apiResource('confirmation_photos', ConfirmationPhotoController::class);
    route::apiResource('invoice_photos', InvoicePhotoController::class);
    route::apiResource('payment_photos', PaymentPhotoController::class);



    route::apiResource('apartment_details', ApartmentDetailController::class);
    route::apiResource('rules', RuleController::class);
    route::apiResource('tour_guides', TourGuideController::class);
    route::apiResource('hotel_seasons', HotelSeasonController::class);
    route::apiResource('offer_seens', OfferSeenController::class);
    route::apiResource('reservations', ReservationController::class);
    route::apiResource('tour_details', TourDetailController::class);
    route::apiResource('hotel_reservations', HotelReservationController::class);
    route::apiResource('users', UserController::class);
    route::apiResource('r_room_categories', RRoomCategoryController::class);

});
