<?php

namespace App\Http\Controllers\Api;

use App\Models\trip;
use Illuminate\Http\JsonResponse;


class TripController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $trips = trip::where('driver_id',auth()->user()->driver->id)->orderBy('created_at', 'desc')->get();
        return $this->sendResponse($trips, 'All trip have arrived.');
    }
}
