<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Donations;
use App\Models\User;
use App\Models\Causes;
use App\Models\Campaigns;
use App\Models\DonationMedia;
use App\Events\Donations\AddDonation;
use App\Helpers\DonationsHelper;
use PDF;
use App\Jobs\NotifyAllAdmins;
use File;

class DonationsController extends Controller
{
    public function index()
    {
        $donations = Donations::orderBy('id', 'DESC')->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'donor_id' => 'required|integer',
            'donation_amount' => 'required|numeric',
            'cause_id' => 'string|exists:causes,id',
            'campaign_id' => 'string|exists:campaigns,id',
            'donation_status' => 'required|integer',
            'payment_method' => 'required|integer',
            'razorpay_payment_id' => 'required_if:payment_method,4',
        ]);
        $donor_name = User::find($request->donor_id)->name;
        $cause_name = $request->cause_id ? Causes::find($request->cause_id)->name : Campaigns::find($request->campaign_id)->name;
        $donation_in_words = Donations::Show_Amount_In_Words($request->donation_amount);
        $request->merge(['donor_name' => $donor_name, 'cause_name' => $cause_name, 'donation_in_words' => $donation_in_words]);
        // event(new AddDonation($request->all(), 1));//1-> add record, 0-> update record
        alert()->success('Yay','Donation was successfully created');
        return redirect()->route('admin.donations.index');
    }

    public function manage(Request $request)
    {
        $donation = Donations::find($request->id);
        $user = User::find($donation->donor_id);
        $all_donations = Donations::all()->where('donor_id', $donation->donor_id)->where('id', '!=', $donation->id);
        $donation_media = ($donation->media_count) ? DonationMedia::where('donation_id', $donation->id)->first() : null;      
        
        return view('admin.donations.manage', compact('donation', 'user', 'all_donations', 'donation_media'));
    }

    public function update(Request $request){
        if ($request->cause_id == 0){
            $request->request->remove('cause_id');
        }
        if ($request->campaign_id == 0){
            $request->request->remove('campaign_id');
        }
        $this->validate($request, [
            'donor_name' => 'required|string',
            'donation_amount' => 'required|numeric',
            'cause_id' => 'sometimes|string|exists:causes,id',
            'campaign_id' => 'sometimes|string|exists:campaigns,id',
            'donation_status' => 'required|integer',
            'payment_method' => 'required|integer',
            'razorpay_payment_id' => 'required_if:payment_method,4',
        ]);

//        Commented this out because it was causing an error - Thirumalai
//        if ($request->cause_id && $request->campaign_id){
//            throw ValidationException::withMessages([
//                'cause_id' => ['Please select either cause or campaign'],
//            ]);
//        }

        $cause_name = $request->cause_id ? Causes::find($request->cause_id)->name : Campaigns::find($request->campaign_id)->name;
        $donation_in_words = Donations::Show_Amount_In_Words($request->donation_amount);
        $request->merge(['cause_name' => $cause_name, 'donation_in_words' => $donation_in_words]);
        $donation = Donations::find($request->id);
        $donation->update($request->all());


        // DonationsHelper::addDonationActivity($donation, 'Donation updated');
        NotifyAllAdmins::dispatch('Donation updated', 'Donation #'.$donation->id.' has been updated by '.auth()->user()->name, 'ALL')->delay(now());
        alert()->success('Yay','Donation was successfully updated');


        return redirect()->route('admin.donations.index');
    }

    public function destroy(Request $request)
    {
        $donation = Donations::find($request->id);
        $donation->delete();        
        $user = auth()->user()->name;
        activity()
            ->performedOn($donation)
            ->causedBy(auth()->user())
            ->log('Deleted a donation (#'.$request->id.') by '.$user);
        alert()->success('Yay','Donation was successfully deleted');
        NotifyAllAdmins::dispatch('Donation deleted', 'Donation #'.$donation->id.' has been deleted by '.auth()->user()->name, 'ALL')->delay(now());
        return redirect()->route('admin.donations.index');
    }

    public function media_store(Request $request)
    {
        DonationsHelper::validateDonationMediaRequest($request);
        $donation = Donations::find($request->donation_id);
        $images = $request->donation_media;
        $c = 0;
        $imageList = array();
        foreach ($images as $image) {
            $info = pathinfo($image);
            $c++;
            $ext = $info['extension'];
            $filename = DIRECTORY_SEPARATOR . 'donation_media'. DIRECTORY_SEPARATOR . $request->donation_id . DIRECTORY_SEPARATOR . "img_$c." . $ext;                        
            if (!File::exists(public_path('storage'.$filename))) {
                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif' || $ext == 'heic') {
                    DonationsHelper::imageWatermark(Storage::disk('local')->path($image), "Donated with love by ".$donation->donor_name);
                }
                else if ($ext == 'mp4' || $ext == 'mov' || $ext == 'avi' || $ext == 'webm' || $ext == 'mpeg') {
                    DonationsHelper::videoWatermark(Storage::disk('local')->path($image));
                }
                Storage::disk('local')->move($image, 'public/'.$filename);
                Storage::disk('local')->delete($image);
            }
            else {
                File::deleteDirectory(public_path('storage'. DIRECTORY_SEPARATOR . 'donation_media'. DIRECTORY_SEPARATOR . $request->donation_id));
                throw ValidationException::withMessages([
                    ['Unable to upload media. Please try again'],
                ])
                ->status(422);
            }            
            $imageList[] = "storage".$filename;
        }
        $donation_media = new DonationMedia();
        $donation_media->donation_id = $request->donation_id;
        $donation_media->media = json_encode($imageList);
        $donation_media->last_modified_by = auth()->user()->id;        
        $donation_media->save();
        $donation->media_count = $c;
        $donation->donation_status = 6;
        $donation->save();
        alert()->success('Yay','Media was successfully added');
        return redirect()->route('admin.donations.index');
    }

    public function media_destroy($id)
    {
        dd($id);
        $donation_media = DonationMedia::find($id);
        $donation = Donations::find($donation_media->donation_id);
        $donation_media->delete();
        $donation->media_count = 0;
        $donation->donation_status = 5;
        $donation->save();
        Storage::disk('public')->deleteDirectory('donation_media/'.$donation->id);
        NotifyAllAdmins::dispatch('Donation Media deleted', 'Donation Media for donation #'.$donation->id.' has been deleted by '.auth()->user()->name, 'ALL')->delay(now());
        alert()->success('Yay','Media was successfully deleted');
        return redirect()->route('admin.donations.index');
    }

    public function media_upload(Request $request)
    {
        if ($request->hasFile('donation_media')) {
            $files = $request->file('donation_media');
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();            
                $extension = $file->getClientOriginalExtension();
                $path = storage_path('donation_media' . DIRECTORY_SEPARATOR . 'tmp');            
                if($this->validate_directory($path)) {
                    $folder = $file->store('donation_media' . DIRECTORY_SEPARATOR . 'tmp');
                    return $folder;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /**
     * validate_directory - If path does not exist, create.
     *
     * @param  mixed $path
     * @return void
     */
    public function validate_directory($path) {
        if(!File::isDirectory($path)){
            if(File::makeDirectory($path, 0777, true, true)) {
                return true;
            } else {
                # Unable to create directory.
                return false;
            }

        } else {
            return true;
        }


    }

}
