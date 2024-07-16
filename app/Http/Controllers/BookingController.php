<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function filter()
    {
        return view('cust.filter');
    }

    public function booking()
    {
        return view('cust.booking');
    }

    public function list(Request $request)
    {
        $query = Package::query();

        if ($request->filled('packageName')) {
            $query->where('package_Name', $request->packageName);
        }

        if ($request->filled('serviceType')) {
            $query->where('service_Type', $request->serviceType);
        }

        if ($request->filled('startDate')) {
            $query->whereDate('start_Date', '>=', $request->startDate);
        }

        if ($request->filled('endDate')) {
            $query->whereDate('end_Date', '<=', $request->endDate);
        }

        if ($request->filled('timeFrom')) {
            $query->whereTime('time_From', '>=', $request->timeFrom);
        }

        if ($request->filled('timeTo')) {
            $query->whereTime('time_To', '<=', $request->timeTo);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('priceRange')) {
            $query->where('price_range', '<=', $request->priceRange);
        }

        $packages = $query->get();

        return view('cust.listBooking', compact('packages'));
    }
    
}

