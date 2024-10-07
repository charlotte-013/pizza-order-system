<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // user
    // direct contact form page
    public function contactFormPage() {
        return view("user.contact.contactForm");
    }

    // contact form
    public function contactForm(Request $request) {
        $this->contactFormValidationCheck($request);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        return redirect()->route("user#contactFormPage")->with(["success" => "Message Send Successfully!"]);
    }

    // admin
    // contact list page
    public function contactList() {
        $contacts = Contact::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(10);
        $contacts->appends(request()->all());
        return view('admin.contact.list', compact('contacts'));
    }

    // contact details page
    public function contactDetails($id) {
        $contact = Contact::where('id', $id)->first();
        return view('admin.contact.details', compact('contact'));
    }

    // contact delete
    public function contactDelete($id) {
        Contact::where('id', $id)->delete();
        return redirect()->route('admin#contactList')->with(["deleteSuccess" => "Contact Deleted"]);
    }

    // contact form validation check
    private function contactFormValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:70',
            'message' => 'required',
        ])->validate();
    }
}
