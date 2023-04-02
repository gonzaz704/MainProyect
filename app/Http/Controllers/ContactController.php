<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|max:100',
            'phone' => 'required|max:100',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

        $data = $request->all();
        Contact::create($data);
        return redirect()->back()->with('message', 'Thank you for getting in touch! . We will get back in touch with you soon!');
    }
}
