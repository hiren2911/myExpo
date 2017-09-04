<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all events which are not ended yet
        $eventlist = Event::where('endDate', '>', NOW())->get();
        return response()->json($eventlist, 200, [], JSON_NUMERIC_CHECK);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->with('stands.user')->first();
        // Fetch events with User details
        // foreach($event->stands as $stand) {
        //     $stand->user = $stand->user;
        // }

        return response()->json($event, 200, [], JSON_NUMERIC_CHECK);
    }
}
