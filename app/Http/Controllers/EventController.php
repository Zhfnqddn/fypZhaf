<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('event');
    }

    public function listEvent(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));
    
        $events = Event::where('start_date', '>=', $start)
            ->where('end_date', '<=' , $end)->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->event_name,
                'serviceType' => $item->service_type,
                'start' => $item->start_date,
                'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                'category' => $item->category,
                'timeFrom' => $item->time_from,
                'timeTo' => $item->time_to,
                'package' => $item->package,
                'packagePrice' => $item->package_price,
                'className' => [$item->service_type == 'Photographer' ? 'event-photographer' : 'event-videographer'],
            ]);
    
        // Log the events being returned
        \Log::info('Events loaded:', $events->toArray());
    
        return response()->json($events);
    }


    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $event = new Event();
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;

    return view('event-form', ['data' => $event, 'action' => route('events.store')]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Log the incoming request data
    \Log::info('Store event request data:', $request->all());

    $event = new Event();
    $event->event_name = $request->title; // Assuming title is event_name
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;
    $event->category = $request->category;  
    $event->service_type = $request->service_type; // Get service_type from request
    $event->time_from = $request->time_from; // Get time_from from request
    $event->time_to = $request->time_to; // Get time_to from request
    $event->package = $request->package; // Get package from request
    $event->package_price = $request->package_price; // Get package_price from request

    $event->save();

    // Log the event data after saving
    \Log::info('Event saved:', $event->toArray());

    return response()->json([
        'status' => 'success',
        'message' => 'Save data successfully'
    ]); 
}

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
{
    return view('event-form', ['data' => $event, 'action' => '']);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event-form', ['data' => $event, 'action' => route('events.update', $event->id)]);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
{
    // Log the incoming request data for debugging
    \Log::info('Update event request data:', $request->all());

    // Ensure correct date handling
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    // Log the received dates
    \Log::info('Received start_date: ' . $start_date);
    \Log::info('Received end_date: ' . $end_date);

    if ($request->has('delete')) {
        return $this->destroy($event);
    }
    $event->start_date = $start_date;
    $event->end_date = $end_date;
    $event->event_name = $request->title;
    $event->category = $request->category;
    $event->service_type = $request->service_type; // Update service_type
    $event->time_from = $request->time_from; // Update time_from
    $event->time_to = $request->time_to; // Update time_to
    $event->package = $request->package; // Update package
    $event->package_price = $request->package_price; // Update package_price

    // Log the event data before saving for debugging
    \Log::info('Event data before saving:', $event->toArray());

    $event->save();

    // Log the event data after saving for debugging
    \Log::info('Event data after saving:', $event->toArray());

    return response()->json([
        'status' => 'success',
        'message' => 'Update data successfully'
    ]);
}

    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted'
        ]);
    }
}
