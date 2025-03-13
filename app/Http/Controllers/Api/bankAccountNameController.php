<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bankAccountName;
use Illuminate\Http\Request;

class bankAccountNameController extends BaseController
{
    public function index()
    {
        $bankAccountNames = BankAccountName::all();
        return $this->sendResponse($bankAccountNames);
    }
}
