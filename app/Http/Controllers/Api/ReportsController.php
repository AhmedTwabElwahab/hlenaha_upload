<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends BaseController
{
    public function index()
    {

        return $this->sendResponse([
            'profit'               => 1000,
            'Profits_from_trips'   => 850,
            'discounts'            => 150,
            'Number_of_trips'      => 3,
        ],'Report is ready');
    }
}
