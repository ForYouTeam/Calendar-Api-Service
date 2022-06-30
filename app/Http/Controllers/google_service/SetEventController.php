<?php

namespace App\Http\Controllers\google_service;

use App\Http\Controllers\Controller;
use App\Interfaces\GServiceInterface;
use App\Models\CalendarServiceModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class SetEventController extends Controller
{
    public function __construct(GServiceInterface $GServiceRepo)
    {
        $this->GServiceRepo = $GServiceRepo;
    }

    public function index()
    {
        $kalender = CalendarServiceModel::all();
        return view('page.Kalender')->with('data', $kalender);
    }

    public function setEvent(Request $request)
    {
        $event = new Event;

        $event->name = $request->name_event;
        $event->startDateTime = Carbon::now()->addMinute(5);
        $event->endDateTime = Carbon::now()->addHour(5);
        $event->description = $request->description;
        $event->location = $request->location;

        $result = $event->save();

        return response()->json($result);
    }

    public function deleteEvent($eventId, $sendUpdate)
    {
        $event = Event::find($eventId);
        $event->sendUpdate = $sendUpdate;
        $event->delete();
        return response()->json([
            'message' => 'Success delete data'
        ]);
    }
}
