<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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


        public function storeBooking(Request $request, $packageId)
        {
            Log::info('storeBooking called');
            Log::info('Request data: ', $request->all());
    
            $request->validate([
                'total_Price' => 'required|numeric',
                'cust_ID' => 'required|exists:customers,cust_ID',
                'package_ID' => 'required|exists:packages,package_ID',
                'package_detail_ID' => 'nullable|exists:package_details,package_detail_ID',
            ]);
    
            Log::info('Validation passed');
    
            try {
                $booking = new Booking();
                $booking->total_Price = $request->input('total_Price');
                $booking->booking_Status = 'Pending';
                $booking->custom_Status = 'Not Customized';
                $booking->cust_ID = $request->input('cust_ID');
                $booking->package_ID = $packageId;
                $booking->package_detail_ID = $request->input('package_detail_ID'); // This can be null
                $booking->save();
    
                Log::info('Booking saved successfully');
    
                return redirect()->route('dashboard')->with('success', 'Your booking is pending');
            } catch (\Exception $e) {
                Log::error('Error saving booking: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to book package.');
            }
        }

















    public function showCustomizeForm($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('cust.custom', compact('package'));
    }
}
