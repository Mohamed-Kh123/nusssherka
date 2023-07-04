<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\MessageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contact =Contact::first();
        return view('front.contact-us', [
            'message' => new MessageContact(),
            'contact' => $contact,
        ]);
    }

    public function store(Request $request)
    {

        MessageContact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        if($request->expectsJson()){
            return response()->json([
                'message' => 'Message sent!',
            ], 201);
        }

        return redirect()->back()->with('success','Message Sent Successfully');
    }
}
