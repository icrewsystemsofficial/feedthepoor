<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Causes;
use App\Models\Campaigns;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CampaignsController extends Controller
{
    public function index(){
        $campaigns = Campaigns::all();
        $locations = Location::groupBy('id')->get(['id', 'location_name']);
        $causes = Causes::groupBy('id')->get(['id', 'name']);  
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
        $request->merge(['campaign_location' => json_encode($request->campaign_location)]);
        $request->merge(['campaign_causes' => json_encode($request->campaign_causes)]);
        $info = pathinfo($request->campaign_poster);
        $ext = $info['extension'];
        
        $filename = 'campaigns/'.$request->campaign_name.'/'.$request->campaign_name.'_poster.'.$ext;
        Storage::disk('public')->move($request->campaign_poster, $filename);
        Storage::disk('public')->delete($request->campaign_poster);
        $request->merge(['campaign_poster' => config('app_url')."/storage/".$filename]); 
        $request->merge(['slug' => Str::slug($request->campaign_name)]);       
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
        Storage::disk('public')->deleteDirectory('campaigns/'.$campaign->campaign_name);
        $campaign->delete();
        alert()->success('Yay','Campaign "'.$campaign->campaign_name.'" was successfully deleted');        
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
        $request->merge(['campaign_location' => json_encode($request->campaign_location)]);
        $request->merge(['campaign_causes' => json_encode($request->campaign_causes)]);
        if ($request->campaign_poster) {
            $info = pathinfo($request->campaign_poster);
            $ext = $info['extension'];
            $filename = 'campaigns/'.$request->campaign_name.'/'.$request->campaign_name.'_poster.'.$ext;
            Storage::disk('public')->move($request->campaign_poster, $filename);
            Storage::disk('public')->delete($request->campaign_poster);
            $request->merge(['campaign_poster' => $filename]);
        }
        else{
            $request->request->remove('campaign_poster');
        }        
        $request->merge(['slug' => Str::slug($request->campaign_name)]);
        $campaign = Campaigns::find($request->id);
        $campaign->update($request->all());
        alert()->success('Yay','Campaign "'.$request->campaign_name.'" was successfully updated');
        return redirect(route('admin.campaigns.index'));
    }

    public function upload(Request $request){
        
        if ($request->hasFile('campaign_poster')) {
            $file = $request->file('campaign_poster');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $folder = $file->store('campaigns/tmp', ['disk' => 'public']);
            return $folder;
        }
        return '';
    }

}
