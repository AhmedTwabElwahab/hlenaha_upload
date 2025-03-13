<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\BannersRequest;
use App\Models\Banners;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Exception;

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

