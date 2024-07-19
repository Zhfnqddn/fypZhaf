<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ToyyibpayController extends Controller
{
    public function createBill(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $customer = $booking->customer;

        $option = array(
            'userSecretKey' => config('toyyibpay.key'),
            'categoryCode' => config('toyyibpay.category'),
            'billName' => 'Booking Payment',
            'billDescription' => 'Payment for booking ID: ' . $bookingId,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $booking->total_Price * 100, // Convert to cents
            'billReturnUrl' => route('toyyibpay-status', ['bookingId' => $bookingId]),
            'billCallbackUrl' => route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'Booking-' . $bookingId,
            'billTo' => $customer->cust_Name,
            'billEmail' => $customer->cust_Email,
            'billPhone' => $customer->cust_PhoneNum,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 2, // 2 for both FPX and credit/debit card payments
            'billContentEmail' => 'Thank you for your payment!',
            'billChargeToCustomer' => 2, // Charge to customer for both FPX and credit card
            'billExpiryDate' => now()->addDays(3)->format('d-m-Y H:i:s'),
            'billExpiryDays' => 3,
            'enableFPXB2B' => 1, // Enable FPX Corporate Banking
            'chargeFPXB2B' => 0 // Charge FPX Corporate Banking to customer
        );

        $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
        $response = Http::asForm()->post($url, $option);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData[0]['BillCode'])) {
                $billCode = $responseData[0]['BillCode'];
                return redirect('https://dev.toyyibpay.com/' . $billCode);
            } else {
                Log::error('BillCode not found in the response', ['response' => $responseData]);
                return response()->json(['error' => 'Failed to create bill. BillCode not found.'], 500);
            }
        } else {
            // Log the response for debugging
            Log::error('Failed to create bill', ['response' => $response->body(), 'status' => $response->status()]);
            return response()->json(['error' => 'Failed to create bill.'], 500);
        }
    }

    public function paymentStatus(Request $request, $bookingId)
    {
        Log::info('Return URL payment status check initiated', ['booking_ID' => $bookingId]);

        $statusId = $request->input('status_id');
        $billCode = $request->input('billcode');
        $orderId = $request->input('order_id');

        if ($statusId == 1) {
            Log::info('Payment successful via return URL', ['booking_ID' => $bookingId, 'billCode' => $billCode]);

            $booking = Booking::findOrFail($bookingId);
            $booking->booking_Status = 'Paid';
            $booking->save();

            Log::info('Booking status updated to Paid', ['booking_ID' => $bookingId, 'status' => $booking->booking_Status]);

            Payment::create([
                'pay_Date' => now()->toDateString(),
                'pay_Time' => now()->toTimeString(),
                'booking_ID' => $bookingId
            ]);

            return redirect()->route('customer.bookings')->with('success', 'Payment made successfully.');
        } elseif ($statusId == 3) {
            Log::warning('Payment failed via return URL', ['booking_ID' => $bookingId, 'billCode' => $billCode]);
            return redirect()->route('customer.bookings')->with('error', 'Payment failed.');
        } else {
            Log::warning('Payment pending via return URL', ['booking_ID' => $bookingId, 'billCode' => $billCode]);
            return redirect()->route('customer.bookings')->with('warning', 'Payment pending.');
        }
    }

    public function callback(Request $request)
    {
        Log::info('Toyyibpay callback received', $request->all());

        $refNo = $request->input('refno');
        $status = $request->input('status');
        $reason = $request->input('reason');
        $billCode = $request->input('billcode');
        $orderId = $request->input('order_id');
        $amount = $request->input('amount');
        $transactionTime = $request->input('transaction_time');

        Log::info('Callback parameters', [
            'refNo' => $refNo,
            'status' => $status,
            'reason' => $reason,
            'billCode' => $billCode,
            'orderId' => $orderId,
            'amount' => $amount,
            'transactionTime' => $transactionTime
        ]);

        if ($status == 1) {
            Log::info('Payment successful via callback', ['orderId' => $orderId]);

            $bookingId = str_replace('Booking-', '', $orderId);
            $booking = Booking::findOrFail($bookingId);
            $booking->booking_Status = 'Paid';
            $booking->save();

            Log::info('Booking status updated to Paid', ['booking_ID' => $bookingId, 'status' => $booking->booking_Status]);

            Payment::create([
                'pay_Date' => now()->toDateString(),
                'pay_Time' => now()->toTimeString(),
                'booking_ID' => $bookingId
            ]);
        } elseif ($status == 3) {
            Log::warning('Payment failed via callback', ['orderId' => $orderId, 'reason' => $reason]);
        } else {
            Log::warning('Payment pending via callback', ['orderId' => $orderId]);
        }

        return response()->json(['status' => 'callback received']);
    }
}
