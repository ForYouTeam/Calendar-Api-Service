<?php

namespace App\Http\Controllers\google_service;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class SetEventController extends Controller
{
    public function setEvent(Request $request)
    {
        $event = new Event;

        $event->name = $request->name_event;
        $event->startDateTime = Carbon::now()->addMinute(5);
        $event->endDateTime = Carbon::now()->addHour(1);

        $result = $event->save();

        return response()->json($result);
    }

    public function deleteEvent($eventId)
    {
        $event = Event::find($eventId);

        $event->delete();
        return response()->json([
            'message' => 'Success delete data'
        ]);
    }
}
