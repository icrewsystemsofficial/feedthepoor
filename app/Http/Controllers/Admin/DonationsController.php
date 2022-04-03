<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Donations;
use App\Models\User;
use App\Models\Causes;
use App\Events\Donations\AddDonation;

class DonationsController extends Controller
{
    public function index()
    {
        $donations = Donations::all();
        return view('admin.donations.index', compact('donations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'donor_id' => 'required|integer',
            'donation_amount' => 'required|numeric',
            'cause_id' => 'required|integer',
            'donation_status' => 'required|integer',
            'payment_method' => 'required|integer',
            'razorpay_payment_id' => 'required_if:payment_method,4',
        ]);
        $donor_name = User::find($request->donor_id)->name;
        $cause_name = Causes::find($request->cause_id)->name;
        $donation_in_words = Donations::Show_Amount_In_Words($request->donation_amount);
        $request->merge(['donor_name' => $donor_name, 'cause_name' => $cause_name, 'donation_in_words' => $donation_in_words]);
        // event(new AddDonation($request->all(), 1));//1-> add record, 0-> update record
        alert()->success('Yay','Donation was successfully created');
        return redirect()->route('admin.donations.index');
    }

    public function manage(Request $request)
    {
        $donation = Donations::find($request->id);
        return view('admin.donations.manage', compact('donation'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'donor_name' => 'required|string',
            'donation_amount' => 'required|numeric',
            'cause_id' => 'required|integer',
            'donation_status' => 'required|integer',
            'payment_method' => 'required|integer',
            'razorpay_payment_id' => 'required_if:payment_method,4',
        ]);
        $donor = User::whereRaw('LOWER(`name`) LIKE ?', [strtolower($request->donor_name)])->first();
        $cause_name = Causes::find($request->cause_id)->name;
        $donor_name = $donor ? $donor->name : $request->donor_name;
        $donor_id = $donor ? $donor->id : null;
        $donor_id ? $request->merge(['donor_id' => $donor_id]) : null;
        $donation_in_words = Donations::Show_Amount_In_Words($request->donation_amount);
        $request->merge(['donor_name' => $donor_name, 'cause_name' => $cause_name, 'donation_in_words' => $donation_in_words]);
        event(new AddDonation($request->all(), 0, $request->id));//1-> add record, 0-> update record
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
        return redirect()->route('admin.donations.index');
    }
}
