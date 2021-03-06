<?php

namespace App\Http\Controllers;

use App\Model\Event;
use Illuminate\Http\Request;
use App\Http\Requests\Event\EventRequest;
use App\Http\Resources\Event\EventResource;
use App\Model\Registration;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.event.index')->with('events', Event::orderBy('date', 'asc')->get());
    }

    public function getEvents()
    {
        return EventResource::collection(Event::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    public function checkEventHistory($id)
    {
        $event_history = Registration::where('event_id', $id)->get();
        if (count($event_history) < 1) {
            return response()->json([
                'data' => false,
                'status' => Response::HTTP_NO_CONTENT
            ]);
        }
        return response()->json([
            'data' => true,
            'id' => $id,
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        Event::create($request->all());
        return redirect()->back()->with('success', 'Successfully added event!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('event.index')->with('success', 'Successfully updated event!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
