<?php

namespace App\Http\Controllers\Api;

use App\Models\Banners;
use Illuminate\Http\JsonResponse;


class BannersController extends BaseController
{
    /**
     * send all banners to frontEnd.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $banners = Banners::all();
        return $this->sendResponse($banners, 'All banners have arrived.');
    }
}

