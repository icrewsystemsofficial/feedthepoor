<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Causes;
use App\Models\Campaigns;
use RahulHaque\Filepond\Facades\Filepond;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CampaignsController extends Controller
{
    public function index(){
        $campaigns = Campaigns::all();
        $locations = Location::groupBy('location_name')->pluck('location_name');
        $causes = Causes::groupBy('name')->pluck('name');        
        return view('admin.campaigns.index', compact('campaigns', 'locations', 'causes'));
    }

    public function store(Request $request){  
        $request->validate([
            'campaign_name' => 'required|string|max:50',
            'campaign_description' => 'required|string|max:150',
            'campaign_poster' => 'required',
            'campaign_goal_amount' => 'required|integer',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'nullable|date',
            'campaign_location' => 'required|array',
            'campaign_causes' => 'nullable|array',
            'campaign_status' => 'required|integer',
        ]);
        $request->merge(['is_campaign_goal_based' => ($request->campaign_end_date) ? true : false]);
        $request->merge(['campaign_has_cause' => ($request->campaign_causes) ? true : false]);
        $fileInfo = Filepond::field($request->campaign_poster)->getFile();        
        $fileNameWithExt = $fileInfo->getClientOriginalName();
        $extension = $fileInfo->getClientOriginalExtension();
        $filename = $request->campaign_name."_poster.".$extension;
        $path = $fileInfo->storeAs('public/campaigns', $filename);
        $request->merge(['campaign_poster' => $path]);
        $request->merge(['campaign_location' => json_encode($request->campaign_location)]);
        $request->merge(['campaign_causes' => json_encode($request->campaign_causes)]);
        Campaigns::create($request->all());
        alert()->success('Yay','Campaign "'.$request->campaign_name.'" was successfully created');
        return redirect(route('admin.campaigns.index'));
    }

    public function manage(Request $request){
        $campaign = Campaigns::find($request->id);     
        return view('admin.campaigns.manage', compact('campaign'));
    }

    public function destroy(Request $request){
        $campaign = Campaigns::find($request->id);
        File::delete(public_path('storage/'.$campaign->campaign_poster));
        alert()->success('Yay','Campaign "'.$campaign->campaign_name.'" was successfully deleted');
        $campaign->delete();
        return redirect(route('admin.campaigns.index'));
    }

    public function update(Request $request){
        $request->validate([
            'campaign_name' => 'required|string|max:50',
            'campaign_description' => 'required|string|max:150',
            'campaign_poster' => 'nullable',
            'campaign_goal_amount' => 'required|integer',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'nullable|date',
            'campaign_location' => 'required|array',
            'campaign_causes' => 'nullable|array',
            'campaign_status' => 'required|integer',
        ]);
        $request->merge(['is_campaign_goal_based' => ($request->campaign_end_date) ? true : false]);
        $request->merge(['campaign_has_cause' => ($request->campaign_causes) ? true : false]);        
        if ($request->campaign_poster) {
            $fileInfo = Filepond::field($request->campaign_poster)->getFile();        
            $fileNameWithExt = $fileInfo->getClientOriginalName();
            $extension = $fileInfo->getClientOriginalExtension();
            $filename = $request->campaign_name."_poster.".$extension;
            $path = $fileInfo->storeAs('public/campaigns', $filename);
            $request->merge(['campaign_poster' => $path]);
        }
        else{
            $request->request->remove('campaign_poster');
        }
        //dd($request->all());
        $request->merge(['campaign_location' => json_encode($request->campaign_location)]);
        $request->merge(['campaign_causes' => json_encode($request->campaign_causes)]);
        $campaign = Campaigns::find($request->id);
        $campaign->update($request->all());
        alert()->success('Yay','Campaign "'.$request->campaign_name.'" was successfully updated');
        return redirect(route('admin.campaigns.index'));
    }

}
