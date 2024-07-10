<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\CustomMarkdownEmail;
use Illuminate\Routing\Controller;

class SendEmailController extends Controller
{
    public function index()
    {
        $pass = 'app'; // Generate or retrieve your password here

        $mailData = [
            'title' => 'Mail From ERP for your password Key',
            'body' => 'Mail for your password to login in erp',
            // 'yourpass' => $pass, // Pass the password to the mail data
        ];

        // Send email with the mail data
        // Mail::to('acharya232ramesh@gmail.com')->send(new CustomMarkdownEmail($mailData));

        dd('email send successfully');
    }
}