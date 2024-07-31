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
    
     public function showBookingPage($packageId, Request $request)
     {
         $package = Package::findOrFail($packageId);
 
         $pictures = [];
         $videos = [];
 
         if ($package->service_Type == 'Photographer') {
             $pictures = Picture::where('staff_ID', $package->staff_ID)->get();
         } elseif ($package->service_Type == 'Videographer') {
             $videos = Video::where('staff_ID', $package->staff_ID)->get();
         }
 
         $customizations = $request->session()->get('customizations', null);
         Log::info('Customizations from session:', (array) $customizations); // Debugging: Log customizations data
     
         $totalPrice = $package->price_range;

         if ($customizations) {
             switch ($customizations->add_Hours) {
                 case 1:
                     $totalPrice += 50;
                     break;
                 case 2:
                     $totalPrice += 100;
                     break;
                 case 3:
                     $totalPrice += 150;
                     break;
                 case 4:
                     $totalPrice += 200;
                     break;
                 case 5:
                     $totalPrice += 250;
                     break;
             }
     
             $addOns = explode(',', $customizations->add_Ons);
             foreach ($addOns as $addOn) {
                 switch ($addOn) {
                     case 'Printing':
                         $totalPrice += 50;
                         break;
                     case 'Editing':
                         $totalPrice += 250;
                         break;
                 }
             }
     
             $addSessions = explode(',', $customizations->add_Session);
             foreach ($addSessions as $addSession) {
                 switch ($addSession) {
                     case 'Indoor':
                         $totalPrice += 50;
                         break;
                     case 'Outdoor':
                         $totalPrice += 150;
                         break;
                 }
             }
     
             $addLocations = explode(',', $customizations->add_Location);
             Log::info('Add Locations:', $addLocations); // Debugging: Log addLocations array

             foreach ($addLocations as $addLocation) {
                 switch ($addLocation) {
                     case 'Studio':
                         $totalPrice += 200;
                         break;
                     case 'CustomerVenue':
                         $totalPrice += 250;
                         break;
                 }
             }
         }
         
         // Debugging: Log totalPrice
         Log::info('Total Price:', ['totalPrice' => $totalPrice]); // Debugging: Log totalPrice

         return view('cust.booking', compact('package', 'pictures', 'videos', 'customizations', 'totalPrice'));
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

            $package = Package::findOrFail($packageId);  // Find the package to get the staff_ID
            Log::info('Package data: ', $package->toArray()); // Log package data to check if staff_ID is present    

             $booking = new Booking();
             $booking->total_Price = $request->input('total_Price');
             $booking->booking_Status = 'Pending';
             $booking->custom_Status = $request->input('package_detail_ID') ? 'Pending' : 'Not Customized';
             $booking->cust_ID = $request->input('cust_ID');
             $booking->package_ID = $packageId;
             $booking->package_detail_ID = $request->input('package_detail_ID'); // This can be null
             $booking->staff_ID = $package->staff_ID;  // Set the staff_ID from the package
            
             Log::info('Booking data before save: ', $booking->toArray()); // Log booking data before save

             $booking->save();
 
             
             Log::info('Booking saved successfully');
 
             return redirect()->route('customer.bookings')->with('success', 'Your booking is pending');
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

    public function processCustomizePackage(Request $request, $packageId)
    {
        $request->validate([
            'addHours' => 'nullable|integer',
            'addOn' => 'nullable|array',
            'addSession' => 'nullable|array',
            'addLocation' => 'nullable|array',
        ]);

        $customizations = new PackageDetail();
        $customizations->add_Hours = $request->input('addHours', 0);
        $customizations->add_Ons = implode(',', $request->input('addOn', []));
        $customizations->add_Session = implode(',', $request->input('addSession', []));
        $customizations->add_Location = implode(',', $request->input('addLocation', []));
        $customizations->cust_ID = Auth::guard('customer')->user()->cust_ID;
        $customizations->package_ID = $packageId;
        $customizations->save();

        // Log the customizations
        Log::info('Customizations saved: ', $customizations->toArray());

        // Pass the customizations to the booking page
        $request->session()->put('customizations', $customizations);

        return redirect()->route('showBookingPage', ['packageId' => $packageId]);
    }
}
