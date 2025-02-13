<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\driver;
use App\Models\Transaction;
use App\Models\trip;


class DashboardController extends Controller
{
    public function index()
    {
        $drivers_count      = driver::all()->count();
        $cars_count         = car::all()->count();
        $transactions_count = Transaction::all()->count();
        $trips_count        = trip::all()->count();

        $drivers_count_last_month       = driver::query()
            ->whereDate('created_at', [now(), now()->subMonth()])->count();
        $cars_count_last_month          = car::query()
            ->whereDate('created_at', [now(), now()->subMonth()])->count();
        $transactions_count_last_month  = Transaction::query()
            ->whereDate('created_at', [now(), now()->subMonth()])->count();
        $trips_count_last_month         = trip::query()
            ->whereDate('created_at', [now(), now()->subMonth()])->count();

        $driver_present         = format_number($drivers_count_last_month / $drivers_count  * 100);
        $car_present            = format_number($cars_count_last_month / $cars_count  * 100);
        $transactions_present   = format_number($transactions_count_last_month / $transactions_count  * 100);
        $trips_present          = format_number($trips_count_last_month / $trips_count  * 100);

        $args = [
            'trips_count',
            'transactions_count',
            'drivers_count',
            'cars_count',
            'driver_present',
            'car_present',
            'transactions_present',
            'trips_present',
        ];

        return view('dashboard.index',compact($args));
    }
}
