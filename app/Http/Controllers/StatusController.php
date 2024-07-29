<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PackageDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

//STAFF ACCEPT OR REJECT CUSTOMER BOOKING
class StatusController extends Controller
{
    public function showBookings()
    {
        $currentUser = Auth::guard('staff')->user();
        Log::info('Current staff user before showing bookings:', ['user' => $currentUser]);

        $bookings = Booking::with('customer')->get();

        Log::info('Current staff user after retrieving bookings:', ['user' => Auth::guard('staff')->user()]);

        return view('staff.accRej', compact('bookings'));
    }

    public function acceptBooking($bookingId)
    {
        $currentUser = Auth::guard('staff')->user();
        Log::info('Current staff user before accepting booking:', ['user' => $currentUser]);

        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Accepted';
        $booking->save();

        Log::info('Current staff user after accepting booking:', ['user' => Auth::guard('staff')->user()]);

        return redirect()->route('bookings')->with('success', 'Booking accepted successfully.');
    }

    public function rejectBooking($bookingId)
    {
        $currentUser = Auth::guard('staff')->user();
        Log::info('Current staff user before rejecting booking:', ['user' => $currentUser]);

        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Rejected';
        $booking->save();

        Log::info('Current staff user after rejecting booking:', ['user' => Auth::guard('staff')->user()]);

        return redirect()->route('bookings')->with('success', 'Booking rejected successfully.');
    }



    //CUSTOMER VIEW STATUS BOOKING
    public function showCustomerBookings()
    {
        $customerId = Auth::guard('customer')->user()->cust_ID;
        $bookings = Booking::with('package')
            ->where('cust_ID', $customerId)
            ->get();
        
        return view('cust.status', compact('bookings'));
    }

    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Cancelled';
        $booking->save();

        return redirect()->route('customer.bookings')->with('success', 'Booking cancelled successfully.');
    }


    //STAFF ACCEPT OR REJECT CUSTOMIZATION

    public function showCustomizations()
    {
        $currentUser = Auth::guard('staff')->user();
        Log::info('Current staff user before showing customizations:', ['user' => $currentUser]);

        $customizations = PackageDetail::with('customer', 'package')->get();

        Log::info('Current staff user after retrieving customizations:', ['user' => Auth::guard('staff')->user()]);

        return view('staff.accRejCustom', compact('customizations'));
    }


    public function acceptCustomization($customizationId)
    {
        $customization = PackageDetail::findOrFail($customizationId);
        $customization->status = 'Accepted';
        $customization->save();
    
        // Update the booking custom status
        $booking = Booking::where('package_detail_ID', $customizationId)->first();
        if ($booking) {
            $booking->custom_Status = 'Accepted';
            $booking->save();
        }
    
        return redirect()->route('customizations')->with('success', 'Customization accepted successfully.');
    }
    
    public function rejectCustomization($customizationId)
    {
        $customization = PackageDetail::findOrFail($customizationId);
        $customization->status = 'Rejected';
        $customization->save();
    
        // Update the booking custom status
        $booking = Booking::where('package_detail_ID', $customizationId)->first();
        if ($booking) {
            $booking->custom_Status = 'Rejected';
            $booking->save();
        }
    
        return redirect()->route('customizations')->with('success', 'Customization rejected successfully.');
    }

     //CUSTOMER VIEW STATUS CUSTOM
     
     public function showCustomerCustomizations()
     {
         $customerId = Auth::guard('customer')->user()->cust_ID;
         $customizations = PackageDetail::with(['package', 'booking'])
             ->whereHas('booking', function($query) use ($customerId) {
                 $query->where('cust_ID', $customerId);
             })
             ->get();


         
         return view('cust.statusCustom', compact('customizations'));
     }

     public function makePayment($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Redirect to Toyyibpay payment page
        return redirect()->route('toyyibpay-create', ['bookingId' => $bookingId]);
    }
}
