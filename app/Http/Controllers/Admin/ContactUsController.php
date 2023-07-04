<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactUsController extends Controller
{
    public function create()
    {
        Gate::authorize('contact.create');

        $contact = Contact::find(1);
        if(!$contact){
            $contact = new Contact();
        }
        return view('admin.contacts.create', [
            'contact' => $contact,
        ]);
    }

    public function update(Request $request)
    {   
        Gate::authorize('contact.create');

        $request->validate([
            'contact_us' => "string|required",
            'address' => "string|required",
            'mobile' => "required|size:13|unique:contacts,mobile,1",
            'email' => "email|required|unique:contacts,email,1",
        ]);

        Contact::updateOrCreate([
            'id' => 1,
        ],[
            'contact_us' => $request->contact_us,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ]);
        
        return redirect()->back()->with('success', 'Contact Updated!');
    }
}
