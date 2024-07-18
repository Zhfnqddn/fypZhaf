<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//STAFF ACCEPT OR REJECT CUSTOMER BOOKING
class StatusController extends Controller
{
    public function showBookings()
    {
        $bookings = Booking::with('customer')->get();
        return view('staff.accRej', compact('bookings'));
    }

    public function acceptBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Accepted';
        $booking->save();

        return redirect()->route('bookings')->with('success', 'Booking accepted successfully.');
    }

    public function rejectBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Rejected';
        $booking->save();

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

    public function makePayment(Request $request, $bookingId)
    {
        // Handle the payment logic here
        // For simplicity, we'll just set the booking status to 'Paid'
        $booking = Booking::findOrFail($bookingId);
        $booking->booking_Status = 'Paid';
        $booking->save();

        return redirect()->route('customer.bookings')->with('success', 'Payment made successfully.');
    }

    //STAFF ACCEPT OR REJECT CUSTOMIZATION

    public function showCustomizations()
    {
        $customizations = PackageDetail::with('customer', 'package')->get();
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
}
