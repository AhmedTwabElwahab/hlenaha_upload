<?php

namespace App\Http\Controllers\Api;

use App\Models\trip;
use Illuminate\Http\Request;


class CarController extends BaseController
{
    public function index(Request $request)
    {
       $driver_id = auth()->user()->driver->id;
       $Car = trip::where('driver_id',$driver_id)
            ->join('cars','trips.car_id', '=', 'cars.id')
            ->select('cars.*', 'trips.id as trip_id', 'trips.created_at as trips_created_at')
            ->orderBy('trips_created_at', 'desc')
            ->get();
       return $this->sendResponse($Car);
    }


}
