<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BaseController extends Controller
{
    public static function msg($status, $msg = '', $code = 200, $data = '')
    {
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $data
        ], $code);
    }
}
