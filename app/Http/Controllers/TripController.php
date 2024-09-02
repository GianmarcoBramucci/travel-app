<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Day;
use Illuminate\Http\Request;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();
        return view('trips.index',compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();
        
        $startDatetime = Carbon::parse($data['start_date']);
        $endDatetime = Carbon::parse($data['end_date']);
        $totalSeconds = $startDatetime->diffInSeconds($endDatetime);
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        
        $data['duration'] = $formattedDuration;
        $data['slug'] = Trip::generateSlug($data['name']);

        $newTrip = Trip::create($data);

        $currentDate = $startDatetime->copy();
        while ($currentDate->lessThanOrEqualTo($endDatetime)) {
            Day::create([
                'trip_id' => $newTrip->id,
                'date' => $currentDate->toDateString(),
            ]);
            $currentDate->addDay();
        }
        return redirect()->route('trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        $days= Day:: all()->where('trip_id', $trip->id);
        return view('trips.days.index', compact('trip', 'days'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        return view('trips.edit',compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
           
        if($trip->name !== $request->input('name')){
            $trip->name = $request->input('name');
            $$trip->slug = Trip::generateSlug($request->input('name'));
        }

        $trip->departure = $request->input('departure');
        $trip->arrival = $request->input('arrival');
        $trip->start_date = $request->input('start_date');
        $trip->end_date = $request->input('end_date');
        $newStartDate = Carbon::parse($request->input('start_date'));
        $newEndDate = Carbon::parse($request->input('end_date'));
        $totalSeconds = $newStartDate->diffInSeconds($newEndDate);
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        $newFormattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        $trip->duration = $newFormattedDuration;
        $trip->save();

        $datesToKeep = [];
        $currentDate = $newStartDate->copy();

        while ($currentDate->lte($newEndDate)) {
            $datesToKeep[] = $currentDate->toDateString();
            $currentDate->addDay();
        }

        $existingDays = $trip->days->pluck('date')->toArray();

        $datesToDelete = array_diff($existingDays, $datesToKeep);
        if (!empty($datesToDelete)) {
            $trip->days()->whereIn('date', $datesToDelete)->delete();
        }

        $existingDaysSet = array_flip($existingDays);
        $datesToAdd = array_diff($datesToKeep, array_keys($existingDaysSet));
        if (!empty($datesToAdd)) {
            foreach ($datesToAdd as $date) {
                $trip->days()->create(['date' => $date]);
            }
        }

        return redirect()->route('trips.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index') /*->with('message', $post->title . ' è stato eliminato')*/;
    }
}
