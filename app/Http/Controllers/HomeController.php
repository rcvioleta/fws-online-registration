<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Event;
use App\Model\Registration;
use App\Model\Team;
use App\Model\Employee;

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
        // Get all events
        $events = Event::all();

        // Get all teams
        $teams = Team::all();
        $team_stats = [];

        // initialize team_stats
        foreach ($events as $event_key => $event) {    
            foreach ($teams as $team_key => $team) {
                $total = Employee::where('team_id', $team->id)->get();
                $team_stats[$event->event_name][$team_key] = [
                    $team->team_name => [
                        'attendance' => 0,
                        'total' => count($total)
                        ]
                    ];
            }
        }

        // foreach ($events as $event_key => $event) { 
        //     $event_records = Registration::where('event_id', $event->id)->get();
        //     foreach ($event_records as $event_record) {
        //         $team_name = $event_record->employee->team->team_name;
        //         $event_name = $event_record->event->event_name;

        //         if ($event_record->status !== 0) {
        //             $team_stats[$event_name][$team_name]['attendance'] += 1;
        //         }
        //     }
        // }

        return view('home', ['team_stats' => $team_stats]);


        /*
        // App\Model\Registration::where('event_id', 1)->first()->employee->team
        
        Original Code

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

        */
    }
}
