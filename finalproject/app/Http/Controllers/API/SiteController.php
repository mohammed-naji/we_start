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
        // return $request->all();
        $data = $request->except('cv');

        $cv = $request->file('cv')->store('uploads/cv', 'custom');

        $data['cv'] = $cv;

        // return $data;

        Mail::to('ahmed.alghoul98@gmail.com')->queue(new ContactMail($data));
    }
}
