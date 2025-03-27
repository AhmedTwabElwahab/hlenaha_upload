<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\trip;
use Illuminate\Http\JsonResponse;


class TripController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $trips = trip::where('driver_id',auth()->user()->driver->id)
            ->join('cars', 'trips.car_id', '=', 'cars.id')
            ->select('trips.*', 'cars.*', 'trips.created_at as trips_created_at')
            ->orderBy('trips_created_at', 'desc')
            ->get()
            ->setHidden([
                'created_at',
                'updated_at',
                'price_day',
                'description',
                'deleted_at'
            ]);
        return $this->sendResponse($trips, 'All trip have arrived.');
    }
}
