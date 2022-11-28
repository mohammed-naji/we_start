<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function contact(Request $request)
    {
        Mail::to('admin@amin.com')->send(new ContactMail());
    }
}
