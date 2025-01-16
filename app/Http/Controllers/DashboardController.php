<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\driver;
use App\Models\Message;
use App\Notifications\activeUserNotification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $drivers_count = driver::all()->count();
        $cars_count = car::all()->count();

        return view('dashboard.index',compact('drivers_count','cars_count'));
    }
}
