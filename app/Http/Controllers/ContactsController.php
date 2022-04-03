<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userContact;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = userContact::all();
        return view('admin.emailContact.index', ['contacts' => $contacts]);
    }

    public function viewContact($id)
    {   
        $contact = userContact::find($id);
        return view('admin.emailContact.contact', ['contact' => $contact]);
    }

    public function deleteContact($id){
        $contact = userContact::find($id);
        alert()->success('Contact   "'.$contact->name.'" was successfully deleted');
        $contact->delete();
        return redirect(route('admin.contact.index'));
    }

    public function mark_Spam($id){
        $contact = userContact::find($id);
        $contact->status = 2;
        $contact->save();
        alert()->success('Contact   "'.$contact->name.'" has been marked as spam');
        return redirect(route('admin.contact.index'));
    }

    public function mark_Contacted($id){
        $contact = userContact::find($id);
        $contact->status = 1;
        $contact->save();
        alert()->success('Contact   "'.$contact->name.'" has been contacted');
        return redirect(route('admin.contact.index'));
    }
}
