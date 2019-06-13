<?php

namespace App\Http\Controllers;

use App\Model\Campaign;
use Illuminate\Http\Request;
use App\Http\Requests\Campaign\CampaignRequest;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.campaign.index')->with('campaigns', Campaign::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
    }

    public function activate($id)
    {
        $campaign = Campaign::find($id);
        $campaign->status = 1;
        $campaign->save();
        return redirect()->back()->with('success', 'Campaign activated!');
    }

    public function deactivate($id)
    {
        $campaign = Campaign::find($id);
        $campaign->status = 0;
        $campaign->save();
        return redirect()->back()->with('success', 'Campaign deactivated!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        Campaign::create($request->all());
        return redirect()->back()->with('success', 'Successfully added new campaign!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaign.edit')->with('campaign', $campaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());
        return redirect()->route('campaign.index')->with('success', 'Successfully updated campaign!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
