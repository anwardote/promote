<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use view,
    Redirect,
        Mail;

class ContactController extends Controller {

    public function create() {
        return view('admin.contacts.create');
    }

    public function store(ContactFormRequest $request) { 
        Mail::send('emails.contact', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
                ), function($message) {            
            $message->from(config('mail.from.address'));
            $message->to(config('mail.from.address'))->subject(config('app.name').' Contact us');
        });
        return Redirect::route('contact.form')->withMessage('Thanks for contacting us!');
    }

}
