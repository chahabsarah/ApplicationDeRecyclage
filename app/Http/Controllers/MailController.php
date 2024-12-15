<?php

namespace App\Http\Controllers;

use App\Mail\RecycleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate and retrieve data from the request
        $data["email"] = $request->input('email'); // Recipient's email
        $data["title"] = "From RecyclingApp";      // Email title
        $data["body"] = $request->input('email_body'); // Email body from the form

        // Send email using the RecycleMail Mailable class
        Mail::to($data["email"])->send(new RecycleMail($data));

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
