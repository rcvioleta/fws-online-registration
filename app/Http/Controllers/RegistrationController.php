<?php

namespace App\Http\Controllers;

use App\Model\Registration;
use Illuminate\Http\Request;
use App\Model\Event;
use App\Http\Requests\Registration\RegistrationRequest;
use App\Model\Campaign;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Registration\RegistrationResource;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.registration.index');
    }

    public function serve($id)
    {
        $registration = $this->getRegByEvent($id);
        return response($registration, Response::HTTP_OK);
    }

    public function getRegByEvent($id)
    {
        $sorted_reg = Registration::where('event_id', $id)->get();
        $registration = [];
        foreach ($sorted_reg as $key => $reg) {
            $registration[$key]['id'] = $reg->id;
            $registration[$key]['e_id'] = $reg->employee->e_id;
            $registration[$key]['full_name'] = $reg->employee->full_name;
            $registration[$key]['campaign'] = $reg->employee->campaign->campaign_name;
            $registration[$key]['status'] = $reg->status;
        }
        return $registration;
    }

    public function register($id)
    {
        $reg = Registration::find($id);
        $reg->status = 1;
        $reg->save();
        return response('Successully registered', Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'admin.registration.create',
            [
                'events' => Event::all(),
                'campaigns' => Campaign::where('status', 1)->get()
            ]
        );
    }

    public function generate()
    {
        return view('admin.registration.show')->with('events', Event::all());
    }

    public function print($id)
    {
        $registration = $this->getRegByEvent($id);
        $registered = 0;
        $total = count($registration);
        foreach ($registration as $reg) {
            if ($reg['status'] !== 0) $registered += 1;
        }
        $event = Event::find($id);
        return view('admin.registration.history', [
            'records' => $registration,
            'attendance_percentage' => $registered / $total * 100 . '%',
            'registered' => $registered,
            'total' => $total,
            'event' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        $registration_exist = Registration::where('event_id', $request->event_id)->get();
        if (count($registration_exist) > 0) {
            return redirect()->back()->with('failed', 'Registration form already exist! Please create a new one instead.');
        }

        foreach ($request->campaign as $key => $campaign_id) {
            $emp_data = Campaign::find($campaign_id)->employee->where('status', 1);
            if (count($emp_data) !== 0) {
                if (count($emp_data) > 1) {
                    foreach ($emp_data as $data) {
                        Registration::create([
                            'employee_id' => $data->id,
                            'event_id' => $request->event_id
                        ]);
                    }
                } else {
                    Registration::create([
                        'employee_id' => $emp_data[0]->id,
                        'event_id' => $request->event_id
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Successfully added new registration form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
