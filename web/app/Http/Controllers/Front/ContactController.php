<?php

namespace App\Http\Controllers\Front;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\UserEmail;

class ContactController extends Controller
{
    /**
     * Store contact message
     *
     * @param ContactRequest $request
     * @param Contact $service
     * @param UserEmail $emailService
     * 
     * @return void
     */
    public function store(ContactRequest $request, Contact $service, UserEmail $emailService)
    {
        // store in db
        $service->create($request->all());

        // send email to admin
        $emailService->sendContactFormToAdmin($request->only('name', 'email', 'message', 'phone'));

        return back()->withInput()->with('msg', 'Email has been sent.');
    }
}
