<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Event;
use App\Model\Registration;
use App\Model\Team;
use App\Model\Employee;
use App\Http\Resources\Statistics\StatisticsResource;
use Symfony\Component\HttpFoundation\Response;

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
        return view('home', ['events' => Event::all()]);
    }

    public function statsByEventId($id)
    {
        $event_registrations = Registration::where('event_id', $id)->get();
        $records = [];

        foreach ($event_registrations as $er_key => $event_registration) {
            $records[$er_key]['event'] = $event_registration->event->event_name;
            $records[$er_key]['campaign'] = $event_registration->campaign->campaign_name;
            $records[$er_key]['team'] = $event_registration->employee->team->team_name;
            $records[$er_key]['status'] = $event_registration->status;
        }

        $teams = Team::all();
        $team_stats = [];

        // initialize team_stats
        foreach ($teams as $team_key => $team) {
            $team_stats[$team_key]['team'] = $team->team_name;
            $team_stats[$team_key]['attendance_count'] = 0;
            $team_stats[$team_key]['total_headcount'] = 0;
        } 

        foreach ($records as $record) {
            foreach ($team_stats as $team_key => $team_stat) {
                if ($team_stat['team'] == $record['team']) {
                    $team_stats[$team_key]['total_headcount'] += 1;
                    if ($record['status'] !== 0) {
                        $team_stats[$team_key]['attendance_count'] += 1;
                    }
                }
            }
        }

        return response($team_stats, Response::HTTP_OK);
    }
}
