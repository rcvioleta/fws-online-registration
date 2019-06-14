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
        $sorted_reg = Registration::where('event_id', $id)->get();
        $registration = [];
        foreach ($sorted_reg as $key => $reg) {
            $registration[$key]['id'] = $reg->id; 
            $registration[$key]['e_id'] = $reg->employee->e_id;
            $registration[$key]['full_name'] = $reg->employee->full_name;
            $registration[$key]['campaign'] = $reg->employee->campaign->campaign_name;
            $registration[$key]['status'] = $reg->status;
        }
        // return response()->json([
        //     'data' => new RegistrationResource($sorted_reg), 
        //     'status' => Response::HTTP_OK
        // ]);
        return response()->json([
            'data' => $registration, 
            'status' => Response::HTTP_OK
        ]);
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
                'campaigns' => Campaign::all()
            ]
        );
    }

    public function generate()
    {
        return view('admin.registration.show')->with('events', Event::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        foreach ($request->campaign as $key => $campaign_id) {
            $emp_data = Campaign::find($campaign_id)->employee;
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

        return redirect()->back()->with(' success ', ' Successfully added new registration form');
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
