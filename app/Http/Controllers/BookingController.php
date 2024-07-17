<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Booking;
use App\Models\PackageDetail;
use App\Models\Picture;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    
        public function showBookingPage($packageId)
        {
            $package = Package::findOrFail($packageId);
        
            $pictures = [];
            $videos = [];
        
            if ($package->service_Type == 'Photographer') {
                $pictures = Picture::where('staff_ID', $package->staff_ID)->get();
            } elseif ($package->service_Type == 'Videographer') {
                $videos = Video::where('staff_ID', $package->staff_ID)->get();
            }
        
            return view('cust.booking', compact('package', 'pictures', 'videos'));
        }



    public function showCustomizeForm($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('cust.custom', compact('package'));
    }
}
