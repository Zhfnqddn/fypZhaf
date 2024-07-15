<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        return view('event');
    }

    public function listEvent(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
        $staffId = Auth::guard('staff')->id();

        $events = Package::where('start_Date', '>=', $start)
            ->where('end_Date', '<=', $end)
            ->where('staff_ID', $staffId) // Filter by staff_ID
            ->get()
            ->map(fn ($item) => [
                'id' => $item->package_ID,
                'packageName' => $item->package_Name,
                'serviceType' => $item->service_Type,
                'start' => $item->start_Date,
                'end' => date('Y-m-d', strtotime($item->end_Date . '+1 days')),
                'timeFrom' => $item->time_From,
                'timeTo' => $item->time_To,
                'location' => $item->location,
                'priceRange' => $item->price_range,
            ]);

        \Log::info('Events loaded:', $events->toArray());

        return response()->json($events);
    }

    public function create(Request $request)
    {
        $event = new Package();
        $event->start_Date = $request->start_date;
        $event->end_Date = $request->end_date;

        // Automatically set the service_type based on the authenticated staff's role
        $staffRole = Auth::guard('staff')->user()->staff_Role;

        return view('event-form', [
            'data' => $event,
            'action' => route('events.store'),
            'staffRole' => $staffRole // Pass the staffRole to the view
        ]);
    }

    public function store(Request $request)
    {
        \Log::info('Store event request data:', $request->all());

        $validator = \Validator::make($request->all(), [
            'package_name' => 'required|string',
            'price_range' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'time_from' => 'required',
            'time_to' => 'required',
            'location' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $staffId = Auth::guard('staff')->id();
            \Log::info('Authenticated Staff ID:', ['staff_id' => $staffId]);

            if (!$staffId) {
                throw new \Exception('Authenticated user not found.');
            }

            $staffRole = Auth::guard('staff')->user()->staff_Role;

            $package = new Package();
            $package->package_Name = $request->package_name;
            $package->service_Type = $staffRole; // Automatically set service_type based on staff_Role
            $package->price_range = $request->price_range;
            $package->start_Date = $request->start_date;
            $package->end_Date = $request->end_date;
            $package->time_From = $request->time_from;
            $package->time_To = $request->time_to;
            $package->location = $request->location;
            $package->staff_ID = $staffId;
            $package->save();

            \Log::info('Package saved:', $package->toArray());

            return response()->json([
                'status' => 'success',
                'message' => 'Save data successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving package:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving the event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Package $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.update', $event->package_ID)]);
    }

    public function edit(Package $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.update', $event->package_ID)]);
    }

    public function update(Request $request, $package_ID)
    {
        \Log::info('Update event request data:', $request->all());

        // Retrieve the specific package using the package_ID from the route
        $package = Package::find($package_ID);
        if (!$package) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package not found'
            ], 404);
        }

        // Validate the request data
        $validator = \Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'time_from' => 'required',
            'time_to' => 'required',
            'location' => 'required|string',
            'package_name' => 'required|string',
            'price_range' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the event details
        $package->start_Date = $request->start_date;
        $package->end_Date = $request->end_date;
        $package->time_From = $request->time_from;
        $package->time_To = $request->time_to;
        $package->location = $request->location;
        $package->package_Name = $request->package_name;
        $package->service_Type = Auth::guard('staff')->user()->staff_Role; // Automatically set service_type based on staff_Role
        $package->price_range = $request->price_range;
        $package->staff_ID = Auth::guard('staff')->id(); // Ensure staff_ID is set

        \Log::info('Package data before saving:', $package->toArray());

        // Save the package and handle errors
        try {
            $package->save();
        } catch (\Exception $e) {
            \Log::error('Error saving package:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving the event',
                'error' => $e->getMessage()
            ], 500);
        }

        \Log::info('Package data after saving:', $package->toArray());

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully'
        ]);
    }

    public function destroy(Package $event)
    {
        try {
            $event->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Event deleted successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting event:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting the event',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
