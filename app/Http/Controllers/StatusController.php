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
    // Ensure staff can only see their own bookings
    public function showBookings()
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;  // Assuming you have a 'staff' guard
        $bookings = Booking::with('customer')
            ->where('staff_ID', $staffId)  // Filter by logged-in staff's ID
            ->get();
        return view('staff.accRej', compact('bookings'));
    }

    public function acceptBooking($bookingId)
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;
        $booking = Booking::where('booking_ID', $bookingId)
            ->where('staff_ID', $staffId)  // Ensure the booking belongs to the logged-in staff
            ->firstOrFail();
        $booking->booking_Status = 'Accepted';
        $booking->save();

        return redirect()->route('bookings')->with('success', 'Booking accepted successfully.');
    }

    public function rejectBooking($bookingId)
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;
        $booking = Booking::where('booking_ID', $bookingId)
            ->where('staff_ID', $staffId)  // Ensure the booking belongs to the logged-in staff
            ->firstOrFail();
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


    //STAFF ACCEPT OR REJECT CUSTOMIZATION

    public function showCustomizations()
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;
        $customizations = PackageDetail::with('customer', 'package')
            ->whereHas('booking', function ($query) use ($staffId) {
                $query->where('staff_ID', $staffId);  // Filter by logged-in staff's bookings
            })
            ->get();
        return view('staff.accRejCustom', compact('customizations'));
    }

    public function acceptCustomization($customizationId)
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;
        $customization = PackageDetail::findOrFail($customizationId);
        // Ensure the customization belongs to the logged-in staff
        $booking = Booking::where('package_detail_ID', $customizationId)
            ->where('staff_ID', $staffId)
            ->firstOrFail();

        $customization->status = 'Accepted';
        $customization->save();

        $booking->custom_Status = 'Accepted';
        $booking->save();

        return redirect()->route('customizations')->with('success', 'Customization accepted successfully.');
    }
    
    public function rejectCustomization($customizationId)
    {
        $staffId = Auth::guard('staff')->user()->staff_ID;
        $customization = PackageDetail::findOrFail($customizationId);
        // Ensure the customization belongs to the logged-in staff
        $booking = Booking::where('package_detail_ID', $customizationId)
            ->where('staff_ID', $staffId)
            ->firstOrFail();

        $customization->status = 'Rejected';
        $customization->save();

        $booking->custom_Status = 'Rejected';
        $booking->save();

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
