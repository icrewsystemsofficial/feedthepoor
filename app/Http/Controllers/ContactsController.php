<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.emailContact.index', ['contacts' => $contacts]);
    }

    public function viewContact($id)
    {   
        $contact = Contact::find($id);
        return view('admin.emailContact.contact', ['contact' => $contact]);
    }

    public function deleteContact($id){
        $contact = Contact::find($id);
        alert()->success('Contact   "'.$contact->name.'" was successfully deleted');
        $contact->delete();
        return redirect(route('admin.contact.index'));
    }

    public function mark_Spam($id){
        $contact = Contact::find($id);
        $contact->status = 2;
        $contact->save();
        alert()->success('Contact   "'.$contact->name.'" has been marked as spam');
        return redirect(route('admin.contact.index'));
    }

    public function mark_Contacted($id){
        $contact = Contact::find($id);
        $contact->status = 1;
        $contact->save();
        alert()->success('Contact   "'.$contact->name.'" has been contacted');
        return redirect(route('admin.contact.index'));
    }
}
