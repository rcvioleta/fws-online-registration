<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Event;
use App\Model\Registration;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::all();
        $filtered_events = [];
        $i = 0;

        foreach ($events as $key => $event) {
            $event_records = Registration::where('event_id', $event->id)->get();
            if (count($event_records) > 0) {
                $filtered_events[$i]['attendance'] = 0;

                foreach ($event_records as $event_record) {
                    if ($event_record['status'] !== 0) {
                        $filtered_events[$i]['attendance'] += 1;
                    } 
                }
                
                $filtered_events[$i]['event_name'] = $event->event_name;
                $filtered_events[$i]['total'] = count($event_records);
                $filtered_events[$i]['percentage'] = $filtered_events[$i]['attendance'] / $filtered_events[$i]['total'] * 100; 

                $i++;
            }
        }

        // return response($filtered_events, 200);
        return view('home')->with('event_records', $filtered_events);
    }
}
