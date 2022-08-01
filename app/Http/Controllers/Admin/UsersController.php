<?php

namespace App\Http\Controllers\admin;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\VolunteerFormRequest;
use App\Mail\VolunteerAccepted;
use App\Mail\VolunteerApplied;
use App\Models\Location;
use App\Models\User;
use App\Models\Donations;
use App\Models\Notification;
use App\Models\VolunteerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(){
        $allRoles = Role::all();
        $location = Location::all();
        $role = 'admin';
        $users = User::all();
        $admins = User::role('administrator')->get();
        $volunteers = User::role('volunteer')->get();
        $donors = User::role('donor')->get();
        return view('admin.users.index', compact('users', 'admins', 'volunteers', 'donors', 'location', 'role', 'allRoles'));
    }

    public function view(){
        $allRoles = Role::all();
        $location = Location::all();
        $user = Auth::user();
        $all_donations = Donations::all()->where('donor_id', Auth::user()->id);
        return view('admin.users.view', compact('location', 'user', 'allRoles', 'all_donations'));
    }


    public function manage($id){
        $location = Location::all();
        $user = User::find($id);
        $allRoles = Role::all();
        $all_donations = Donations::all()->where('donor_id', $id);
        return view('admin.users.view', compact('location', 'user', 'allRoles', 'all_donations'));
    }

    public function update(Request $req, $id){
        $user = User::find($id);
        $roles = $user->getRoleNames();

        if($roles->count() > 0) {
            $user->removeRole($roles[0]);
        }

        $user->assignRole($req->input('user_role'));
        $user->name = $req->name;
        $user->email = $req->email;
        $user->assignRole($req->input('user_role'));
        $user->pan_number = $req->pan_number;
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;
        $user->location_id = $req->location_id;
        if ($req->hasFile('avatar')) {

            $path = $req->file('avatar')->store('public/avatars');

            $url = Storage::url($path);

            $imgpath = str_replace('/storage', storage_path() . '/app/public', $url);

            $img = Image::make($imgpath);

            $img->fit(250);

            $img->save();

            $user->avatar = $url;
        }
        $user->save();

        alert()->success('Yay!','User '. $user->name .' has been updated!');
        return redirect()->route('admin.users.index');
    }

    public function update_password(Request $req, $id){
        $this->validate($req, [
            'curr_password' => 'curr_password|required',
            'new_password' => 'new_password|required',
        ]);
        $user = User::find($id);
        if($user->password == $req->curr_password){
            $user->password = $req->new_password;
            return(redirect(route('admin.dashboard')));
        }else{
            alert()->error('OOPS!','The Password you enetered is incorrect');
            return redirect()->back();
        }
    }

    public function create(Request $req){
        $this->validate($req, [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'user_address' => 'required',
            'user_location_id' => 'required',
            'user_role' => 'required',
        ]);
        $user = new User;
        $user->name = $req->input('user_name');
        $user->email = $req->input('user_email');
        $user->password = $req->input('user_password');
        $user->address = $req->input('user_address');
        $user->phone_number = $req->input('user_phone_number');
        $user->location_id = $req->input('user_location_id');
        $user->assignRole($req->input('user_role'));
        $user->save();
        return(redirect()->back());
    }

    public function destroy($id){
        $user = User::find($id);
        alert()->success('Yay','User "'.$user->name.'" was successfully deleted');
        $user->delete();
        return (redirect(route('admin.users.index')));
    }


    //VLOUNTEER

    public function volunteer_apply(){
        return view('frontend.volunteer.apply');
    }

    public function submit_request(VolunteerFormRequest $request){
        $users = User::role('superadmin')->get();
        $notification = new NotificationHelper;
        foreach ($users as $user) {
            $notification->user($user)->content('Volunteer Request', 'A Request has been filed for new Volunteer')->action('{{route("admin.users.volunteer_applications")}}')->notify();
        }
        VolunteerRequest::create($request->validated());

        $details = [
            'name' => $request->name,
            'email' => $request->email
        ];
//        Sending an email to the volunteer that we have recived their request
        $email = new VolunteerApplied($details);
        Mail::to($request->email)->send($email);

        return redirect(route('frontend.volunteer.apply'))->with('status','Your volunteer request submitted successfully');
    }

    public function volunteer_applications(){
        $applicants = VolunteerRequest::all();
        return view('admin.users.volunteer')->with('users', $applicants);
    }

    public function destroy_volunteer($id){
        $user = VolunteerRequest::find($id);
        alert()->success('Yay','User "'.$user->name.'" was successfully deleted');
        $user->delete();
        return redirect(route('admin.users.volunteer_applications'));
    }

    public function volunteer_accept(Request $req, $id){
        $user = new User;
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = bcrypt($req->input('email'));
        $user->address = $req->input('address');
        $user->phone_number = $req->input('phone_number');
        $loc = Location::where('location_name', $req->input('city'))->get();
        if($loc){
            $user->location_id = $loc;
        }else{
            $user->location_id = 1;
        }

        $user->assignRole('volunteer');
        $user->save();
        VolunteerRequest::find($id)->delete();

        $details = [
          'name' => $user->name,
          'email' => $user->email,
          'password' => $user->email,
        ];

        $email = new VolunteerAccepted($details);
        Mail::to($user->email)->send($email);

        alert()->success('Yay','A new volunteer has been added');
        return (redirect(route('admin.users.volunteer_applications')));
    }

    public function manage_application($id){
        $user = VolunteerRequest::find($id);
        return view('admin.users.view_volunteer')->with('user', $user);
    }
}
